<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntitiesTypeRequest;
use App\Http\Requests\UpdateEntitiesTypeRequest;
use App\Http\Resources\Admin\EntitiesTypeResource;
use App\Models\EntitiesType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entities_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesTypeResource(EntitiesType::with(['status'])->get());
    }

    public function store(StoreEntitiesTypeRequest $request)
    {
        $entitiesType = EntitiesType::create($request->all());

        return (new EntitiesTypeResource($entitiesType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EntitiesType $entitiesType)
    {
        abort_if(Gate::denies('entities_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesTypeResource($entitiesType->load(['status']));
    }

    public function update(UpdateEntitiesTypeRequest $request, EntitiesType $entitiesType)
    {
        $entitiesType->update($request->all());

        return (new EntitiesTypeResource($entitiesType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EntitiesType $entitiesType)
    {
        abort_if(Gate::denies('entities_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
