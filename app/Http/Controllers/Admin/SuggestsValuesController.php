<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuggestsValueRequest;
use App\Http\Requests\StoreSuggestsValueRequest;
use App\Http\Requests\UpdateSuggestsValueRequest;
use App\Models\Country;
use App\Models\Language;
use App\Models\Status;
use App\Models\Suggest;
use App\Models\SuggestsValue;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuggestsValuesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('suggests_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SuggestsValue::with(['suggest', 'language', 'country', 'status'])->select(sprintf('%s.*', (new SuggestsValue)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'suggests_value_show';
                $editGate      = 'suggests_value_edit';
                $deleteGate    = 'suggests_value_delete';
                $crudRoutePart = 'suggests-values';

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
            $table->addColumn('suggest_name', function ($row) {
                return $row->suggest ? $row->suggest->name : '';
            });

            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('picto', function ($row) {
                if ($photo = $row->picto) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('files', function ($row) {
                if (! $row->files) {
                    return '';
                }
                $links = [];
                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('pictures', function ($row) {
                if (! $row->pictures) {
                    return '';
                }
                $links = [];
                foreach ($row->pictures as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('table_link', function ($row) {
                return $row->table_link ? $row->table_link : '';
            });
            $table->editColumn('table_link_value', function ($row) {
                return $row->table_link_value ? $row->table_link_value : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'suggest', 'language', 'country', 'picto', 'files', 'pictures', 'status']);

            return $table->make(true);
        }

        return view('admin.suggestsValues.index');
    }

    public function create()
    {
        abort_if(Gate::denies('suggests_value_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggests = Suggest::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suggestsValues.create', compact('countries', 'languages', 'statuses', 'suggests'));
    }

    public function store(StoreSuggestsValueRequest $request)
    {
        $suggestsValue = SuggestsValue::create($request->all());

        if ($request->input('picto', false)) {
            $suggestsValue->addMedia(storage_path('tmp/uploads/' . basename($request->input('picto'))))->toMediaCollection('picto');
        }

        foreach ($request->input('files', []) as $file) {
            $suggestsValue->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        foreach ($request->input('pictures', []) as $file) {
            $suggestsValue->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $suggestsValue->id]);
        }

        return redirect()->route('admin.suggests-values.index');
    }

    public function edit(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggests = Suggest::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suggestsValue->load('suggest', 'language', 'country', 'status');

        return view('admin.suggestsValues.edit', compact('countries', 'languages', 'statuses', 'suggests', 'suggestsValue'));
    }

    public function update(UpdateSuggestsValueRequest $request, SuggestsValue $suggestsValue)
    {
        $suggestsValue->update($request->all());

        if ($request->input('picto', false)) {
            if (! $suggestsValue->picto || $request->input('picto') !== $suggestsValue->picto->file_name) {
                if ($suggestsValue->picto) {
                    $suggestsValue->picto->delete();
                }
                $suggestsValue->addMedia(storage_path('tmp/uploads/' . basename($request->input('picto'))))->toMediaCollection('picto');
            }
        } elseif ($suggestsValue->picto) {
            $suggestsValue->picto->delete();
        }

        if (count($suggestsValue->files) > 0) {
            foreach ($suggestsValue->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $suggestsValue->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $suggestsValue->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        if (count($suggestsValue->pictures) > 0) {
            foreach ($suggestsValue->pictures as $media) {
                if (! in_array($media->file_name, $request->input('pictures', []))) {
                    $media->delete();
                }
            }
        }
        $media = $suggestsValue->pictures->pluck('file_name')->toArray();
        foreach ($request->input('pictures', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $suggestsValue->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
            }
        }

        return redirect()->route('admin.suggests-values.index');
    }

    public function show(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggestsValue->load('suggest', 'language', 'country', 'status');

        return view('admin.suggestsValues.show', compact('suggestsValue'));
    }

    public function destroy(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggestsValue->delete();

        return back();
    }

    public function massDestroy(MassDestroySuggestsValueRequest $request)
    {
        $suggestsValues = SuggestsValue::find(request('ids'));

        foreach ($suggestsValues as $suggestsValue) {
            $suggestsValue->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('suggests_value_create') && Gate::denies('suggests_value_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SuggestsValue();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
