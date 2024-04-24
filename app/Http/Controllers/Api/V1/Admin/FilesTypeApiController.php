<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilesTypeRequest;
use App\Http\Requests\UpdateFilesTypeRequest;
use App\Http\Resources\Admin\FilesTypeResource;
use App\Models\FilesType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilesTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('files_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FilesTypeResource(FilesType::with(['status'])->get());
    }

    public function store(StoreFilesTypeRequest $request)
    {
        $filesType = FilesType::create($request->all());

        return (new FilesTypeResource($filesType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FilesType $filesType)
    {
        abort_if(Gate::denies('files_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FilesTypeResource($filesType->load(['status']));
    }

    public function update(UpdateFilesTypeRequest $request, FilesType $filesType)
    {
        $filesType->update($request->all());

        return (new FilesTypeResource($filesType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FilesType $filesType)
    {
        abort_if(Gate::denies('files_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $filesType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
