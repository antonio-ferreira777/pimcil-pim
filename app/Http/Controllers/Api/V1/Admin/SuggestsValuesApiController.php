<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSuggestsValueRequest;
use App\Http\Requests\UpdateSuggestsValueRequest;
use App\Http\Resources\Admin\SuggestsValueResource;
use App\Models\SuggestsValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuggestsValuesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('suggests_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuggestsValueResource(SuggestsValue::with(['suggest', 'language', 'country', 'status'])->get());
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

        return (new SuggestsValueResource($suggestsValue))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuggestsValueResource($suggestsValue->load(['suggest', 'language', 'country', 'status']));
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

        return (new SuggestsValueResource($suggestsValue))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SuggestsValue $suggestsValue)
    {
        abort_if(Gate::denies('suggests_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggestsValue->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
