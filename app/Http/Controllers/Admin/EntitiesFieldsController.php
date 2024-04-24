<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntitiesFieldRequest;
use App\Http\Requests\StoreEntitiesFieldRequest;
use App\Http\Requests\UpdateEntitiesFieldRequest;
use App\Models\EntitiesField;
use App\Models\Entity;
use App\Models\Field;
use App\Models\Language;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesFieldsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entities_field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntitiesField::with(['entity', 'field', 'language', 'status'])->select(sprintf('%s.*', (new EntitiesField)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entities_field_show';
                $editGate      = 'entities_field_edit';
                $deleteGate    = 'entities_field_delete';
                $crudRoutePart = 'entities-fields';

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

            $table->editColumn('field_value', function ($row) {
                return $row->field_value ? $row->field_value : '';
            });
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'field', 'language', 'status']);

            return $table->make(true);
        }

        return view('admin.entitiesFields.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entities_field_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fields = Field::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entitiesFields.create', compact('entities', 'fields', 'languages', 'statuses'));
    }

    public function store(StoreEntitiesFieldRequest $request)
    {
        $entitiesField = EntitiesField::create($request->all());

        return redirect()->route('admin.entities-fields.index');
    }

    public function edit(EntitiesField $entitiesField)
    {
        abort_if(Gate::denies('entities_field_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fields = Field::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entitiesField->load('entity', 'field', 'language', 'status');

        return view('admin.entitiesFields.edit', compact('entities', 'entitiesField', 'fields', 'languages', 'statuses'));
    }

    public function update(UpdateEntitiesFieldRequest $request, EntitiesField $entitiesField)
    {
        $entitiesField->update($request->all());

        return redirect()->route('admin.entities-fields.index');
    }

    public function show(EntitiesField $entitiesField)
    {
        abort_if(Gate::denies('entities_field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesField->load('entity', 'field', 'language', 'status');

        return view('admin.entitiesFields.show', compact('entitiesField'));
    }

    public function destroy(EntitiesField $entitiesField)
    {
        abort_if(Gate::denies('entities_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesField->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntitiesFieldRequest $request)
    {
        $entitiesFields = EntitiesField::find(request('ids'));

        foreach ($entitiesFields as $entitiesField) {
            $entitiesField->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
