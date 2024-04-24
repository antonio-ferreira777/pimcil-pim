<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntitiesFileRequest;
use App\Http\Requests\StoreEntitiesFileRequest;
use App\Http\Requests\UpdateEntitiesFileRequest;
use App\Models\EntitiesFile;
use App\Models\Entity;
use App\Models\File;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesFilesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entities_file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntitiesFile::with(['entity', 'file', 'status'])->select(sprintf('%s.*', (new EntitiesFile)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entities_file_show';
                $editGate      = 'entities_file_edit';
                $deleteGate    = 'entities_file_delete';
                $crudRoutePart = 'entities-files';

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

            $table->editColumn('entity.name', function ($row) {
                return $row->entity ? (is_string($row->entity) ? $row->entity : $row->entity->name) : '';
            });
            $table->addColumn('file_name', function ($row) {
                return $row->file ? $row->file->name : '';
            });

            $table->editColumn('display_order', function ($row) {
                return $row->display_order ? $row->display_order : '';
            });
            $table->editColumn('is_default', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_default ? 'checked' : null) . '>';
            });
            $table->editColumn('to_use', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->to_use ? 'checked' : null) . '>';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'file', 'is_default', 'to_use', 'status']);

            return $table->make(true);
        }

        return view('admin.entitiesFiles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entities_file_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $files = File::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entitiesFiles.create', compact('entities', 'files', 'statuses'));
    }

    public function store(StoreEntitiesFileRequest $request)
    {
        $entitiesFile = EntitiesFile::create($request->all());

        return redirect()->route('admin.entities-files.index');
    }

    public function edit(EntitiesFile $entitiesFile)
    {
        abort_if(Gate::denies('entities_file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $files = File::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entitiesFile->load('entity', 'file', 'status');

        return view('admin.entitiesFiles.edit', compact('entities', 'entitiesFile', 'files', 'statuses'));
    }

    public function update(UpdateEntitiesFileRequest $request, EntitiesFile $entitiesFile)
    {
        $entitiesFile->update($request->all());

        return redirect()->route('admin.entities-files.index');
    }

    public function show(EntitiesFile $entitiesFile)
    {
        abort_if(Gate::denies('entities_file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesFile->load('entity', 'file', 'status');

        return view('admin.entitiesFiles.show', compact('entitiesFile'));
    }

    public function destroy(EntitiesFile $entitiesFile)
    {
        abort_if(Gate::denies('entities_file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesFile->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntitiesFileRequest $request)
    {
        $entitiesFiles = EntitiesFile::find(request('ids'));

        foreach ($entitiesFiles as $entitiesFile) {
            $entitiesFile->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
