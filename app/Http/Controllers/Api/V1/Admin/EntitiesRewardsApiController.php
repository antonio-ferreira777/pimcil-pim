<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntitiesRewardRequest;
use App\Http\Requests\UpdateEntitiesRewardRequest;
use App\Http\Resources\Admin\EntitiesRewardResource;
use App\Models\EntitiesReward;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesRewardsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entities_reward_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesRewardResource(EntitiesReward::with(['entity', 'reward'])->get());
    }

    public function store(StoreEntitiesRewardRequest $request)
    {
        $entitiesReward = EntitiesReward::create($request->all());

        return (new EntitiesRewardResource($entitiesReward))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EntitiesReward $entitiesReward)
    {
        abort_if(Gate::denies('entities_reward_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntitiesRewardResource($entitiesReward->load(['entity', 'reward']));
    }

    public function update(UpdateEntitiesRewardRequest $request, EntitiesReward $entitiesReward)
    {
        $entitiesReward->update($request->all());

        return (new EntitiesRewardResource($entitiesReward))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EntitiesReward $entitiesReward)
    {
        abort_if(Gate::denies('entities_reward_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesReward->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
