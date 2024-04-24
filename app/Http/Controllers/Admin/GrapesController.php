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

class GrapesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('grape_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grapes = Grape::with(['status', 'media'])->get();

        return view('admin.grapes.index', compact('grapes'));
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
