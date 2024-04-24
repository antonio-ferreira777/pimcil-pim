<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntitiesFieldRequest;
use App\Http\Requests\UpdateEntitiesFieldRequest;
use App\Http\Resources\Admin\EntitiesFieldResource;
use App\Models\EntitiesField;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesFieldsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entities_field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesFieldResource(EntitiesField::with(['entity', 'field', 'language', 'status'])->get());
    }

    public function store(StoreEntitiesFieldRequest $request)
    {
        $entitiesField = EntitiesField::create($request->all());

        return (new EntitiesFieldResource($entitiesField))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EntitiesField $entitiesField)
    {
        abort_if(Gate::denies('entities_field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesFieldResource($entitiesField->load(['entity', 'field', 'language', 'status']));
    }

    public function update(UpdateEntitiesFieldRequest $request, EntitiesField $entitiesField)
    {
        $entitiesField->update($request->all());

        return (new EntitiesFieldResource($entitiesField))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EntitiesField $entitiesField)
    {
        abort_if(Gate::denies('entities_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesField->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
