<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntityRequest;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\UpdateEntityRequest;
use App\Models\EntitiesType;
use App\Models\Entity;
use App\Models\Language;
use App\Models\Taxonomy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Entity::with(['taxonomy', 'type', 'team', 'language'])->select(sprintf('%s.*', (new Entity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entity_show';
                $editGate      = 'entity_edit';
                $deleteGate    = 'entity_delete';
                $crudRoutePart = 'entities';

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
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : '';
            });
            $table->editColumn('ean', function ($row) {
                return $row->ean ? $row->ean : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('taxonomy_id_parent', function ($row) {
                return $row->taxonomy ? $row->taxonomy->id_parent : '';
            });

            $table->addColumn('type_name', function ($row) {
                return $row->type ? $row->type->name : '';
            });

            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'taxonomy', 'type', 'language']);

            return $table->make(true);
        }

        return view('admin.entities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomies = Taxonomy::pluck('id_parent', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = EntitiesType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entities.create', compact('languages', 'taxonomies', 'types'));
    }

    public function store(StoreEntityRequest $request)
    {
        $entity = Entity::create($request->all());

        return redirect()->route('admin.entities.index');
    }

    public function edit(Entity $entity)
    {
        abort_if(Gate::denies('entity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomies = Taxonomy::pluck('id_parent', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = EntitiesType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entity->load('taxonomy', 'type', 'team', 'language');

        return view('admin.entities.edit', compact('entity', 'languages', 'taxonomies', 'types'));
    }

    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        $entity->update($request->all());

        return redirect()->route('admin.entities.index');
    }

    public function show(Entity $entity)
    {
        abort_if(Gate::denies('entity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entity->load('taxonomy', 'type', 'team', 'language', 'entityEntitiesFields');

        return view('admin.entities.show', compact('entity'));
    }

    public function destroy(Entity $entity)
    {
        abort_if(Gate::denies('entity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entity->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntityRequest $request)
    {
        $entities = Entity::find(request('ids'));

        foreach ($entities as $entity) {
            $entity->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
