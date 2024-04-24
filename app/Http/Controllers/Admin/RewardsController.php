<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRewardRequest;
use App\Http\Requests\StoreRewardRequest;
use App\Http\Requests\UpdateRewardRequest;
use App\Models\Reward;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RewardsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reward_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rewards = Reward::with(['status', 'media'])->get();

        return view('admin.rewards.index', compact('rewards'));
    }

    public function create()
    {
        abort_if(Gate::denies('reward_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rewards.create', compact('statuses'));
    }

    public function store(StoreRewardRequest $request)
    {
        $reward = Reward::create($request->all());

        if ($request->input('picto', false)) {
            $reward->addMedia(storage_path('tmp/uploads/' . basename($request->input('picto'))))->toMediaCollection('picto');
        }

        foreach ($request->input('doc', []) as $file) {
            $reward->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('doc');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $reward->id]);
        }

        return redirect()->route('admin.rewards.index');
    }

    public function edit(Reward $reward)
    {
        abort_if(Gate::denies('reward_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reward->load('status');

        return view('admin.rewards.edit', compact('reward', 'statuses'));
    }

    public function update(UpdateRewardRequest $request, Reward $reward)
    {
        $reward->update($request->all());

        if ($request->input('picto', false)) {
            if (! $reward->picto || $request->input('picto') !== $reward->picto->file_name) {
                if ($reward->picto) {
                    $reward->picto->delete();
                }
                $reward->addMedia(storage_path('tmp/uploads/' . basename($request->input('picto'))))->toMediaCollection('picto');
            }
        } elseif ($reward->picto) {
            $reward->picto->delete();
        }

        if (count($reward->doc) > 0) {
            foreach ($reward->doc as $media) {
                if (! in_array($media->file_name, $request->input('doc', []))) {
                    $media->delete();
                }
            }
        }
        $media = $reward->doc->pluck('file_name')->toArray();
        foreach ($request->input('doc', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $reward->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('doc');
            }
        }

        return redirect()->route('admin.rewards.index');
    }

    public function show(Reward $reward)
    {
        abort_if(Gate::denies('reward_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reward->load('status');

        return view('admin.rewards.show', compact('reward'));
    }

    public function destroy(Reward $reward)
    {
        abort_if(Gate::denies('reward_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reward->delete();

        return back();
    }

    public function massDestroy(MassDestroyRewardRequest $request)
    {
        $rewards = Reward::find(request('ids'));

        foreach ($rewards as $reward) {
            $reward->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('reward_create') && Gate::denies('reward_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Reward();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
