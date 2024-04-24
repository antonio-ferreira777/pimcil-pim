<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuggestsValueRequest;
use App\Http\Requests\UpdateSuggestsValueRequest;
use App\Http\Resources\Admin\SuggestsValueResource;
use App\Models\SuggestsValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuggestsValuesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('suggests_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuggestsValueResource(SuggestsValue::with(['suggest', 'language', 'country', 'status'])->get());
    }

    public function store(StoreSuggestsValueRequest $request)
    {
        $suggestsValue = SuggestsValue::create($request->all());

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
