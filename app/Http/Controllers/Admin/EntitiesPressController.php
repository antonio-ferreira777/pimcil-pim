<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntitiesPressRequest;
use App\Http\Requests\StoreEntitiesPressRequest;
use App\Http\Requests\UpdateEntitiesPressRequest;
use App\Models\EntitiesPress;
use App\Models\Entity;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesPressController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entities_press_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntitiesPress::with(['entity', 'status'])->select(sprintf('%s.*', (new EntitiesPress)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entities_press_show';
                $editGate      = 'entities_press_edit';
                $deleteGate    = 'entities_press_delete';
                $crudRoutePart = 'entities-presses';

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

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : '';
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'status']);

            return $table->make(true);
        }

        return view('admin.entitiesPresses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entities_press_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entitiesPresses.create', compact('entities', 'statuses'));
    }

    public function store(StoreEntitiesPressRequest $request)
    {
        $entitiesPress = EntitiesPress::create($request->all());

        return redirect()->route('admin.entities-presses.index');
    }

    public function edit(EntitiesPress $entitiesPress)
    {
        abort_if(Gate::denies('entities_press_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entitiesPress->load('entity', 'status');

        return view('admin.entitiesPresses.edit', compact('entities', 'entitiesPress', 'statuses'));
    }

    public function update(UpdateEntitiesPressRequest $request, EntitiesPress $entitiesPress)
    {
        $entitiesPress->update($request->all());

        return redirect()->route('admin.entities-presses.index');
    }

    public function show(EntitiesPress $entitiesPress)
    {
        abort_if(Gate::denies('entities_press_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesPress->load('entity', 'status');

        return view('admin.entitiesPresses.show', compact('entitiesPress'));
    }

    public function destroy(EntitiesPress $entitiesPress)
    {
        abort_if(Gate::denies('entities_press_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesPress->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntitiesPressRequest $request)
    {
        $entitiesPresses = EntitiesPress::find(request('ids'));

        foreach ($entitiesPresses as $entitiesPress) {
            $entitiesPress->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
