<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProducerRequest;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Models\Country;
use App\Models\Producer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProducersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('producer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $producers = Producer::with(['country', 'media'])->get();

        return view('admin.producers.index', compact('producers'));
    }

    public function create()
    {
        abort_if(Gate::denies('producer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.producers.create', compact('countries'));
    }

    public function store(StoreProducerRequest $request)
    {
        $producer = Producer::create($request->all());

        if ($request->input('logo', false)) {
            $producer->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $producer->id]);
        }

        return redirect()->route('admin.producers.index');
    }

    public function edit(Producer $producer)
    {
        abort_if(Gate::denies('producer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $producer->load('country');

        return view('admin.producers.edit', compact('countries', 'producer'));
    }

    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        $producer->update($request->all());

        if ($request->input('logo', false)) {
            if (! $producer->logo || $request->input('logo') !== $producer->logo->file_name) {
                if ($producer->logo) {
                    $producer->logo->delete();
                }
                $producer->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($producer->logo) {
            $producer->logo->delete();
        }

        return redirect()->route('admin.producers.index');
    }

    public function show(Producer $producer)
    {
        abort_if(Gate::denies('producer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $producer->load('country');

        return view('admin.producers.show', compact('producer'));
    }

    public function destroy(Producer $producer)
    {
        abort_if(Gate::denies('producer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $producer->delete();

        return back();
    }

    public function massDestroy(MassDestroyProducerRequest $request)
    {
        $producers = Producer::find(request('ids'));

        foreach ($producers as $producer) {
            $producer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('producer_create') && Gate::denies('producer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Producer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
