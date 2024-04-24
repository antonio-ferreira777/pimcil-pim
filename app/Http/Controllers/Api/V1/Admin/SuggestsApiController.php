<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuggestRequest;
use App\Http\Requests\UpdateSuggestRequest;
use App\Http\Resources\Admin\SuggestResource;
use App\Models\Suggest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuggestsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('suggest_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuggestResource(Suggest::with(['status'])->get());
    }

    public function store(StoreSuggestRequest $request)
    {
        $suggest = Suggest::create($request->all());

        return (new SuggestResource($suggest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Suggest $suggest)
    {
        abort_if(Gate::denies('suggest_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuggestResource($suggest->load(['status']));
    }

    public function update(UpdateSuggestRequest $request, Suggest $suggest)
    {
        $suggest->update($request->all());

        return (new SuggestResource($suggest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Suggest $suggest)
    {
        abort_if(Gate::denies('suggest_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suggest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
