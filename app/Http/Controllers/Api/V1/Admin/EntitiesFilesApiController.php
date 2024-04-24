<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntitiesFileRequest;
use App\Http\Requests\UpdateEntitiesFileRequest;
use App\Http\Resources\Admin\EntitiesFileResource;
use App\Models\EntitiesFile;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesFilesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entities_file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesFileResource(EntitiesFile::with(['entity', 'file', 'status'])->get());
    }

    public function store(StoreEntitiesFileRequest $request)
    {
        $entitiesFile = EntitiesFile::create($request->all());

        return (new EntitiesFileResource($entitiesFile))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EntitiesFile $entitiesFile)
    {
        abort_if(Gate::denies('entities_file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesFileResource($entitiesFile->load(['entity', 'file', 'status']));
    }

    public function update(UpdateEntitiesFileRequest $request, EntitiesFile $entitiesFile)
    {
        $entitiesFile->update($request->all());

        return (new EntitiesFileResource($entitiesFile))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EntitiesFile $entitiesFile)
    {
        abort_if(Gate::denies('entities_file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesFile->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
