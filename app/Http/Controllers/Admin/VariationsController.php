<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVariationRequest;
use App\Http\Requests\StoreVariationRequest;
use App\Http\Requests\UpdateVariationRequest;
use App\Models\Entity;
use App\Models\Field;
use App\Models\Variation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VariationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('variation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Variation::with(['entity', 'field', 'master_entity'])->select(sprintf('%s.*', (new Variation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'variation_show';
                $editGate      = 'variation_edit';
                $deleteGate    = 'variation_delete';
                $crudRoutePart = 'variations';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('entity_ref', function ($row) {
                return $row->entity ? $row->entity->ref : '';
            });

            $table->addColumn('field_name', function ($row) {
                return $row->field ? $row->field->name : '';
            });

            $table->addColumn('master_entity_ref', function ($row) {
                return $row->master_entity ? $row->master_entity->ref : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'field', 'master_entity']);

            return $table->make(true);
        }

        return view('admin.variations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('variation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fields = Field::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $master_entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.variations.create', compact('entities', 'fields', 'master_entities'));
    }

    public function store(StoreVariationRequest $request)
    {
        $variation = Variation::create($request->all());

        return redirect()->route('admin.variations.index');
    }

    public function edit(Variation $variation)
    {
        abort_if(Gate::denies('variation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fields = Field::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $master_entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variation->load('entity', 'field', 'master_entity');

        return view('admin.variations.edit', compact('entities', 'fields', 'master_entities', 'variation'));
    }

    public function update(UpdateVariationRequest $request, Variation $variation)
    {
        $variation->update($request->all());

        return redirect()->route('admin.variations.index');
    }

    public function show(Variation $variation)
    {
        abort_if(Gate::denies('variation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variation->load('entity', 'field', 'master_entity');

        return view('admin.variations.show', compact('variation'));
    }

    public function destroy(Variation $variation)
    {
        abort_if(Gate::denies('variation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variation->delete();

        return back();
    }

    public function massDestroy(MassDestroyVariationRequest $request)
    {
        $variations = Variation::find(request('ids'));

        foreach ($variations as $variation) {
            $variation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
