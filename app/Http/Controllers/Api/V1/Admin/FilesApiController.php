<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Http\Resources\Admin\FileResource;
use App\Models\File;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FileResource(File::with(['type', 'team', 'status'])->get());
    }

    public function store(StoreFileRequest $request)
    {
        $file = File::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $file->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        foreach ($request->input('path', []) as $file) {
            $file->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('path');
        }

        return (new FileResource($file))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(File $file)
    {
        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FileResource($file->load(['type', 'team', 'status']));
    }

    public function update(UpdateFileRequest $request, File $file)
    {
        $file->update($request->all());

        if (count($file->file) > 0) {
            foreach ($file->file as $media) {
                if (! in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $file->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $file->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        if (count($file->path) > 0) {
            foreach ($file->path as $media) {
                if (! in_array($media->file_name, $request->input('path', []))) {
                    $media->delete();
                }
            }
        }
        $media = $file->path->pluck('file_name')->toArray();
        foreach ($request->input('path', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $file->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('path');
            }
        }

        return (new FileResource($file))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(File $file)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $file->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
