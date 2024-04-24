<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWinemakerRequest;
use App\Http\Requests\UpdateWinemakerRequest;
use App\Http\Resources\Admin\WinemakerResource;
use App\Models\Winemaker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WinemakersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('winemaker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WinemakerResource(Winemaker::with(['status'])->get());
    }

    public function store(StoreWinemakerRequest $request)
    {
        $winemaker = Winemaker::create($request->all());

        foreach ($request->input('pictures', []) as $file) {
            $winemaker->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
        }

        return (new WinemakerResource($winemaker))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Winemaker $winemaker)
    {
        abort_if(Gate::denies('winemaker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WinemakerResource($winemaker->load(['status']));
    }

    public function update(UpdateWinemakerRequest $request, Winemaker $winemaker)
    {
        $winemaker->update($request->all());

        if (count($winemaker->pictures) > 0) {
            foreach ($winemaker->pictures as $media) {
                if (! in_array($media->file_name, $request->input('pictures', []))) {
                    $media->delete();
                }
            }
        }
        $media = $winemaker->pictures->pluck('file_name')->toArray();
        foreach ($request->input('pictures', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $winemaker->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('pictures');
            }
        }

        return (new WinemakerResource($winemaker))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Winemaker $winemaker)
    {
        abort_if(Gate::denies('winemaker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winemaker->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
