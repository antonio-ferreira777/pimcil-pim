<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFieldRequest;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Entity;
use App\Models\Field;
use App\Models\FormBloc;
use App\Models\Language;
use App\Models\Status;
use App\Models\Taxonomy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FieldsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Field::with(['form_blocs', 'taxonomies', 'channels', 'languages', 'countries', 'entities', 'status'])->select(sprintf('%s.*', (new Field)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'field_show';
                $editGate      = 'field_edit';
                $deleteGate    = 'field_delete';
                $crudRoutePart = 'fields';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Field::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('default', function ($row) {
                return $row->default ? $row->default : '';
            });
            $table->editColumn('nullable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->nullable ? 'checked' : null) . '>';
            });
            $table->editColumn('form_bloc', function ($row) {
                $labels = [];
                foreach ($row->form_blocs as $form_bloc) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $form_bloc->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('taxonomy', function ($row) {
                $labels = [];
                foreach ($row->taxonomies as $taxonomy) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $taxonomy->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('channels', function ($row) {
                $labels = [];
                foreach ($row->channels as $channel) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $channel->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('languages', function ($row) {
                $labels = [];
                foreach ($row->languages as $language) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $language->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('countries', function ($row) {
                $labels = [];
                foreach ($row->countries as $country) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $country->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('entities', function ($row) {
                $labels = [];
                foreach ($row->entities as $entity) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $entity->ref);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('taxonomy_transversality', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->taxonomy_transversality ? 'checked' : null) . '>';
            });
            $table->editColumn('channels_transversality', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->channels_transversality ? 'checked' : null) . '>';
            });
            $table->editColumn('language_transversality', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->language_transversality ? 'checked' : null) . '>';
            });
            $table->editColumn('countries_transversality', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->countries_transversality ? 'checked' : null) . '>';
            });
            $table->editColumn('entities_transversality', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->entities_transversality ? 'checked' : null) . '>';
            });
            $table->editColumn('display_order', function ($row) {
                return $row->display_order ? $row->display_order : '';
            });
            $table->editColumn('data_source', function ($row) {
                return $row->data_source ? $row->data_source : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nullable', 'form_bloc', 'taxonomy', 'channels', 'languages', 'countries', 'entities', 'taxonomy_transversality', 'channels_transversality', 'language_transversality', 'countries_transversality', 'entities_transversality', 'status']);

            return $table->make(true);
        }

        return view('admin.fields.index');
    }

    public function create()
    {
        abort_if(Gate::denies('field_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $form_blocs = FormBloc::pluck('name', 'id');

        $taxonomies = Taxonomy::pluck('name', 'id');

        $channels = Channel::pluck('name', 'id');

        $languages = Language::pluck('name', 'id');

        $countries = Country::pluck('name', 'id');

        $entities = Entity::pluck('ref', 'id');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fields.create', compact('channels', 'countries', 'entities', 'form_blocs', 'languages', 'statuses', 'taxonomies'));
    }

    public function store(StoreFieldRequest $request)
    {
        $field = Field::create($request->all());
        $field->form_blocs()->sync($request->input('form_blocs', []));
        $field->taxonomies()->sync($request->input('taxonomies', []));
        $field->channels()->sync($request->input('channels', []));
        $field->languages()->sync($request->input('languages', []));
        $field->countries()->sync($request->input('countries', []));
        $field->entities()->sync($request->input('entities', []));

        return redirect()->route('admin.fields.index');
    }

    public function edit(Field $field)
    {
        abort_if(Gate::denies('field_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $form_blocs = FormBloc::pluck('name', 'id');

        $taxonomies = Taxonomy::pluck('name', 'id');

        $channels = Channel::pluck('name', 'id');

        $languages = Language::pluck('name', 'id');

        $countries = Country::pluck('name', 'id');

        $entities = Entity::pluck('ref', 'id');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field->load('form_blocs', 'taxonomies', 'channels', 'languages', 'countries', 'entities', 'status');

        return view('admin.fields.edit', compact('channels', 'countries', 'entities', 'field', 'form_blocs', 'languages', 'statuses', 'taxonomies'));
    }

    public function update(UpdateFieldRequest $request, Field $field)
    {
        $field->update($request->all());
        $field->form_blocs()->sync($request->input('form_blocs', []));
        $field->taxonomies()->sync($request->input('taxonomies', []));
        $field->channels()->sync($request->input('channels', []));
        $field->languages()->sync($request->input('languages', []));
        $field->countries()->sync($request->input('countries', []));
        $field->entities()->sync($request->input('entities', []));

        return redirect()->route('admin.fields.index');
    }

    public function show(Field $field)
    {
        abort_if(Gate::denies('field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field->load('form_blocs', 'taxonomies', 'channels', 'languages', 'countries', 'entities', 'status');

        return view('admin.fields.show', compact('field'));
    }

    public function destroy(Field $field)
    {
        abort_if(Gate::denies('field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field->delete();

        return back();
    }

    public function massDestroy(MassDestroyFieldRequest $request)
    {
        $fields = Field::find(request('ids'));

        foreach ($fields as $field) {
            $field->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
