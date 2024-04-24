<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFylesTypeRequest;
use App\Http\Requests\UpdateFylesTypeRequest;
use App\Http\Resources\Admin\FylesTypeResource;
use App\Models\FylesType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FylesTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fyles_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FylesTypeResource(FylesType::with(['status'])->get());
    }

    public function store(StoreFylesTypeRequest $request)
    {
        $fylesType = FylesType::create($request->all());

        return (new FylesTypeResource($fylesType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FylesType $fylesType)
    {
        abort_if(Gate::denies('fyles_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FylesTypeResource($fylesType->load(['status']));
    }

    public function update(UpdateFylesTypeRequest $request, FylesType $fylesType)
    {
        $fylesType->update($request->all());

        return (new FylesTypeResource($fylesType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FylesType $fylesType)
    {
        abort_if(Gate::denies('fyles_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fylesType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
