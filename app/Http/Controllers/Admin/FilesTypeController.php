<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFilesTypeRequest;
use App\Http\Requests\StoreFilesTypeRequest;
use App\Http\Requests\UpdateFilesTypeRequest;
use App\Models\FilesType;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FilesTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('files_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FilesType::with(['status'])->select(sprintf('%s.*', (new FilesType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'files_type_show';
                $editGate      = 'files_type_edit';
                $deleteGate    = 'files_type_delete';
                $crudRoutePart = 'files-types';

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

        return view('admin.filesTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('files_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.filesTypes.create', compact('statuses'));
    }

    public function store(StoreFilesTypeRequest $request)
    {
        $filesType = FilesType::create($request->all());

        return redirect()->route('admin.files-types.index');
    }

    public function edit(FilesType $filesType)
    {
        abort_if(Gate::denies('files_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $filesType->load('status');

        return view('admin.filesTypes.edit', compact('filesType', 'statuses'));
    }

    public function update(UpdateFilesTypeRequest $request, FilesType $filesType)
    {
        $filesType->update($request->all());

        return redirect()->route('admin.files-types.index');
    }

    public function show(FilesType $filesType)
    {
        abort_if(Gate::denies('files_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filesType->load('status');

        return view('admin.filesTypes.show', compact('filesType'));
    }

    public function destroy(FilesType $filesType)
    {
        abort_if(Gate::denies('files_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filesType->delete();

        return back();
    }

    public function massDestroy(MassDestroyFilesTypeRequest $request)
    {
        $filesTypes = FilesType::find(request('ids'));

        foreach ($filesTypes as $filesType) {
            $filesType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
