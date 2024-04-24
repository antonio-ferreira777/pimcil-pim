<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaxonomyRequest;
use App\Http\Requests\UpdateTaxonomyRequest;
use App\Http\Resources\Admin\TaxonomyResource;
use App\Models\Taxonomy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('taxonomy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaxonomyResource(Taxonomy::with(['status'])->get());
    }

    public function store(StoreTaxonomyRequest $request)
    {
        $taxonomy = Taxonomy::create($request->all());

        return (new TaxonomyResource($taxonomy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Taxonomy $taxonomy)
    {
        abort_if(Gate::denies('taxonomy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TaxonomyResource($taxonomy->load(['status']));
    }

    public function update(UpdateTaxonomyRequest $request, Taxonomy $taxonomy)
    {
        $taxonomy->update($request->all());

        return (new TaxonomyResource($taxonomy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Taxonomy $taxonomy)
    {
        abort_if(Gate::denies('taxonomy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
