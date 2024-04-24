<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocalizationRequest;
use App\Http\Requests\UpdateLocalizationRequest;
use App\Http\Resources\Admin\LocalizationResource;
use App\Models\Localization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('localization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalizationResource(Localization::with(['language'])->get());
    }

    public function store(StoreLocalizationRequest $request)
    {
        $localization = Localization::create($request->all());

        return (new LocalizationResource($localization))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Localization $localization)
    {
        abort_if(Gate::denies('localization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalizationResource($localization->load(['language']));
    }

    public function update(UpdateLocalizationRequest $request, Localization $localization)
    {
        $localization->update($request->all());

        return (new LocalizationResource($localization))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Localization $localization)
    {
        abort_if(Gate::denies('localization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localization->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
