<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFylesTypeRequest;
use App\Http\Requests\StoreFylesTypeRequest;
use App\Http\Requests\UpdateFylesTypeRequest;
use App\Models\FylesType;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FylesTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fyles_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FylesType::with(['status'])->select(sprintf('%s.*', (new FylesType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fyles_type_show';
                $editGate      = 'fyles_type_edit';
                $deleteGate    = 'fyles_type_delete';
                $crudRoutePart = 'fyles-types';

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

        return view('admin.fylesTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fyles_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fylesTypes.create', compact('statuses'));
    }

    public function store(StoreFylesTypeRequest $request)
    {
        $fylesType = FylesType::create($request->all());

        return redirect()->route('admin.fyles-types.index');
    }

    public function edit(FylesType $fylesType)
    {
        abort_if(Gate::denies('fyles_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fylesType->load('status');

        return view('admin.fylesTypes.edit', compact('fylesType', 'statuses'));
    }

    public function update(UpdateFylesTypeRequest $request, FylesType $fylesType)
    {
        $fylesType->update($request->all());

        return redirect()->route('admin.fyles-types.index');
    }

    public function show(FylesType $fylesType)
    {
        abort_if(Gate::denies('fyles_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fylesType->load('status');

        return view('admin.fylesTypes.show', compact('fylesType'));
    }

    public function destroy(FylesType $fylesType)
    {
        abort_if(Gate::denies('fyles_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fylesType->delete();

        return back();
    }

    public function massDestroy(MassDestroyFylesTypeRequest $request)
    {
        $fylesTypes = FylesType::find(request('ids'));

        foreach ($fylesTypes as $fylesType) {
            $fylesType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
