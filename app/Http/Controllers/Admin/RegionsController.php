<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRegionRequest;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Country;
use App\Models\Region;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::with(['country'])->get();

        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        abort_if(Gate::denies('region_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.regions.create', compact('countries'));
    }

    public function store(StoreRegionRequest $request)
    {
        $region = Region::create($request->all());

        return redirect()->route('admin.regions.index');
    }

    public function edit(Region $region)
    {
        abort_if(Gate::denies('region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $region->load('country');

        return view('admin.regions.edit', compact('countries', 'region'));
    }

    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->update($request->all());

        return redirect()->route('admin.regions.index');
    }

    public function show(Region $region)
    {
        abort_if(Gate::denies('region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $region->load('country');

        return view('admin.regions.show', compact('region'));
    }

    public function destroy(Region $region)
    {
        abort_if(Gate::denies('region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $region->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegionRequest $request)
    {
        $regions = Region::find(request('ids'));

        foreach ($regions as $region) {
            $region->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
