<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGrapeRequest;
use App\Http\Requests\UpdateGrapeRequest;
use App\Http\Resources\Admin\GrapeResource;
use App\Models\Grape;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GrapesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('grape_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GrapeResource(Grape::with(['country', 'status'])->get());
    }

    public function store(StoreGrapeRequest $request)
    {
        $grape = Grape::create($request->all());

        foreach ($request->input('pictures', []) as $file) {
            $grape->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
        }

        return (new GrapeResource($grape))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Grape $grape)
    {
        abort_if(Gate::denies('grape_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GrapeResource($grape->load(['country', 'status']));
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

        return (new GrapeResource($grape))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Grape $grape)
    {
        abort_if(Gate::denies('grape_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $grape->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
