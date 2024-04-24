<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGrapeRequest;
use App\Http\Requests\StoreGrapeRequest;
use App\Http\Requests\UpdateGrapeRequest;
use App\Models\Grape;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GrapesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('grape_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Grape::with(['status'])->select(sprintf('%s.*', (new Grape)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'grape_show';
                $editGate      = 'grape_edit';
                $deleteGate    = 'grape_delete';
                $crudRoutePart = 'grapes';

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
            $table->editColumn('synonyms', function ($row) {
                return $row->synonyms ? $row->synonyms : '';
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
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
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'pictures', 'status']);

            return $table->make(true);
        }

        return view('admin.grapes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('grape_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.grapes.create', compact('statuses'));
    }

    public function store(StoreGrapeRequest $request)
    {
        $grape = Grape::create($request->all());

        foreach ($request->input('pictures', []) as $file) {
            $grape->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $grape->id]);
        }

        return redirect()->route('admin.grapes.index');
    }

    public function edit(Grape $grape)
    {
        abort_if(Gate::denies('grape_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $grape->load('status');

        return view('admin.grapes.edit', compact('grape', 'statuses'));
    }

    public function update(UpdateGrapeRequest $request, Grape $grape)
    {
        $grape->update($request->all());

        if (count($grape->pictures) > 0) {
            foreach ($grape->pictures as $media) {
                if (! in_array($media->file_name, $request->input('pictures', []))) {
                    $media->delete();
                }
            }
        }
        $media = $grape->pictures->pluck('file_name')->toArray();
        foreach ($request->input('pictures', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $grape->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
            }
        }

        return redirect()->route('admin.grapes.index');
    }

    public function show(Grape $grape)
    {
        abort_if(Gate::denies('grape_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grape->load('status');

        return view('admin.grapes.show', compact('grape'));
    }

    public function destroy(Grape $grape)
    {
        abort_if(Gate::denies('grape_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grape->delete();

        return back();
    }

    public function massDestroy(MassDestroyGrapeRequest $request)
    {
        $grapes = Grape::find(request('ids'));

        foreach ($grapes as $grape) {
            $grape->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('grape_create') && Gate::denies('grape_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Grape();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
