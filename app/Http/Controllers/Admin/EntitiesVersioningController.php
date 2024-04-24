<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntitiesVersioningRequest;
use App\Http\Requests\StoreEntitiesVersioningRequest;
use App\Http\Requests\UpdateEntitiesVersioningRequest;
use App\Models\EntitiesVersioning;
use App\Models\Entity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesVersioningController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entities_versioning_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntitiesVersioning::with(['entity'])->select(sprintf('%s.*', (new EntitiesVersioning)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entities_versioning_show';
                $editGate      = 'entities_versioning_edit';
                $deleteGate    = 'entities_versioning_delete';
                $crudRoutePart = 'entities-versionings';

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

            $table->editColumn('values', function ($row) {
                return $row->values ? $row->values : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity']);

            return $table->make(true);
        }

        return view('admin.entitiesVersionings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entities_versioning_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entitiesVersionings.create', compact('entities'));
    }

    public function store(StoreEntitiesVersioningRequest $request)
    {
        $entitiesVersioning = EntitiesVersioning::create($request->all());

        return redirect()->route('admin.entities-versionings.index');
    }

    public function edit(EntitiesVersioning $entitiesVersioning)
    {
        abort_if(Gate::denies('entities_versioning_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entitiesVersioning->load('entity');

        return view('admin.entitiesVersionings.edit', compact('entities', 'entitiesVersioning'));
    }

    public function update(UpdateEntitiesVersioningRequest $request, EntitiesVersioning $entitiesVersioning)
    {
        $entitiesVersioning->update($request->all());

        return redirect()->route('admin.entities-versionings.index');
    }

    public function show(EntitiesVersioning $entitiesVersioning)
    {
        abort_if(Gate::denies('entities_versioning_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesVersioning->load('entity');

        return view('admin.entitiesVersionings.show', compact('entitiesVersioning'));
    }

    public function destroy(EntitiesVersioning $entitiesVersioning)
    {
        abort_if(Gate::denies('entities_versioning_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesVersioning->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntitiesVersioningRequest $request)
    {
        $entitiesVersionings = EntitiesVersioning::find(request('ids'));

        foreach ($entitiesVersionings as $entitiesVersioning) {
            $entitiesVersioning->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
