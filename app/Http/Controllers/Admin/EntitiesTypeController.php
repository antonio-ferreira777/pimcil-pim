<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntitiesTypeRequest;
use App\Http\Requests\StoreEntitiesTypeRequest;
use App\Http\Requests\UpdateEntitiesTypeRequest;
use App\Models\EntitiesType;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entities_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntitiesType::with(['status'])->select(sprintf('%s.*', (new EntitiesType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entities_type_show';
                $editGate      = 'entities_type_edit';
                $deleteGate    = 'entities_type_delete';
                $crudRoutePart = 'entities-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status']);

            return $table->make(true);
        }

        return view('admin.entitiesTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entities_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entitiesTypes.create', compact('statuses'));
    }

    public function store(StoreEntitiesTypeRequest $request)
    {
        $entitiesType = EntitiesType::create($request->all());

        return redirect()->route('admin.entities-types.index');
    }

    public function edit(EntitiesType $entitiesType)
    {
        abort_if(Gate::denies('entities_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entitiesType->load('status');

        return view('admin.entitiesTypes.edit', compact('entitiesType', 'statuses'));
    }

    public function update(UpdateEntitiesTypeRequest $request, EntitiesType $entitiesType)
    {
        $entitiesType->update($request->all());

        return redirect()->route('admin.entities-types.index');
    }

    public function show(EntitiesType $entitiesType)
    {
        abort_if(Gate::denies('entities_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesType->load('status');

        return view('admin.entitiesTypes.show', compact('entitiesType'));
    }

    public function destroy(EntitiesType $entitiesType)
    {
        abort_if(Gate::denies('entities_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesType->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntitiesTypeRequest $request)
    {
        $entitiesTypes = EntitiesType::find(request('ids'));

        foreach ($entitiesTypes as $entitiesType) {
            $entitiesType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
