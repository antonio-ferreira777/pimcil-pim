<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntitiesVersioningRequest;
use App\Http\Requests\UpdateEntitiesVersioningRequest;
use App\Http\Resources\Admin\EntitiesVersioningResource;
use App\Models\EntitiesVersioning;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesVersioningApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entities_versioning_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesVersioningResource(EntitiesVersioning::with(['entity'])->get());
    }

    public function store(StoreEntitiesVersioningRequest $request)
    {
        $entitiesVersioning = EntitiesVersioning::create($request->all());

        return (new EntitiesVersioningResource($entitiesVersioning))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EntitiesVersioning $entitiesVersioning)
    {
        abort_if(Gate::denies('entities_versioning_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesVersioningResource($entitiesVersioning->load(['entity']));
    }

    public function update(UpdateEntitiesVersioningRequest $request, EntitiesVersioning $entitiesVersioning)
    {
        $entitiesVersioning->update($request->all());

        return (new EntitiesVersioningResource($entitiesVersioning))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EntitiesVersioning $entitiesVersioning)
    {
        abort_if(Gate::denies('entities_versioning_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesVersioning->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
