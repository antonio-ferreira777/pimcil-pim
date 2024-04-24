<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntitiesPressRequest;
use App\Http\Requests\UpdateEntitiesPressRequest;
use App\Http\Resources\Admin\EntitiesPressResource;
use App\Models\EntitiesPress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesPressApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entities_press_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesPressResource(EntitiesPress::with(['entity', 'status'])->get());
    }

    public function store(StoreEntitiesPressRequest $request)
    {
        $entitiesPress = EntitiesPress::create($request->all());

        return (new EntitiesPressResource($entitiesPress))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EntitiesPress $entitiesPress)
    {
        abort_if(Gate::denies('entities_press_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesPressResource($entitiesPress->load(['entity', 'status']));
    }

    public function update(UpdateEntitiesPressRequest $request, EntitiesPress $entitiesPress)
    {
        $entitiesPress->update($request->all());

        return (new EntitiesPressResource($entitiesPress))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EntitiesPress $entitiesPress)
    {
        abort_if(Gate::denies('entities_press_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesPress->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
