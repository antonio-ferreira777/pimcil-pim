<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWinemakerRequest;
use App\Http\Requests\StoreWinemakerRequest;
use App\Http\Requests\UpdateWinemakerRequest;
use App\Models\Status;
use App\Models\Winemaker;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WinemakersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('winemaker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winemakers = Winemaker::with(['status', 'media'])->get();

        return view('admin.winemakers.index', compact('winemakers'));
    }

    public function create()
    {
        abort_if(Gate::denies('winemaker_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.winemakers.create', compact('statuses'));
    }

    public function store(StoreWinemakerRequest $request)
    {
        $winemaker = Winemaker::create($request->all());

        foreach ($request->input('pictures', []) as $file) {
            $winemaker->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $winemaker->id]);
        }

        return redirect()->route('admin.winemakers.index');
    }

    public function edit(Winemaker $winemaker)
    {
        abort_if(Gate::denies('winemaker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $winemaker->load('status');

        return view('admin.winemakers.edit', compact('statuses', 'winemaker'));
    }

    public function update(UpdateWinemakerRequest $request, Winemaker $winemaker)
    {
        $winemaker->update($request->all());

        if (count($winemaker->pictures) > 0) {
            foreach ($winemaker->pictures as $media) {
                if (! in_array($media->file_name, $request->input('pictures', []))) {
                    $media->delete();
                }
            }
        }
        $media = $winemaker->pictures->pluck('file_name')->toArray();
        foreach ($request->input('pictures', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $winemaker->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
            }
        }

        return redirect()->route('admin.winemakers.index');
    }

    public function show(Winemaker $winemaker)
    {
        abort_if(Gate::denies('winemaker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winemaker->load('status');

        return view('admin.winemakers.show', compact('winemaker'));
    }

    public function destroy(Winemaker $winemaker)
    {
        abort_if(Gate::denies('winemaker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winemaker->delete();

        return back();
    }

    public function massDestroy(MassDestroyWinemakerRequest $request)
    {
        $winemakers = Winemaker::find(request('ids'));

        foreach ($winemakers as $winemaker) {
            $winemaker->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('winemaker_create') && Gate::denies('winemaker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Winemaker();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
