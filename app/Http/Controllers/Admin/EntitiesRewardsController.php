<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEntitiesRewardRequest;
use App\Http\Requests\StoreEntitiesRewardRequest;
use App\Http\Requests\UpdateEntitiesRewardRequest;
use App\Models\EntitiesReward;
use App\Models\Entity;
use App\Models\Reward;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntitiesRewardsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('entities_reward_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntitiesReward::with(['entity', 'reward'])->select(sprintf('%s.*', (new EntitiesReward)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entities_reward_show';
                $editGate      = 'entities_reward_edit';
                $deleteGate    = 'entities_reward_delete';
                $crudRoutePart = 'entities-rewards';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('entity_ref', function ($row) {
                return $row->entity ? $row->entity->ref : '';
            });

            $table->addColumn('reward_name', function ($row) {
                return $row->reward ? $row->reward->name : '';
            });

            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : '';
            });

            $table->editColumn('points', function ($row) {
                return $row->points ? $row->points : '';
            });
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'reward']);

            return $table->make(true);
        }

        return view('admin.entitiesRewards.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entities_reward_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rewards = Reward::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entitiesRewards.create', compact('entities', 'rewards'));
    }

    public function store(StoreEntitiesRewardRequest $request)
    {
        $entitiesReward = EntitiesReward::create($request->all());

        return redirect()->route('admin.entities-rewards.index');
    }

    public function edit(EntitiesReward $entitiesReward)
    {
        abort_if(Gate::denies('entities_reward_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rewards = Reward::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entitiesReward->load('entity', 'reward');

        return view('admin.entitiesRewards.edit', compact('entities', 'entitiesReward', 'rewards'));
    }

    public function update(UpdateEntitiesRewardRequest $request, EntitiesReward $entitiesReward)
    {
        $entitiesReward->update($request->all());

        return redirect()->route('admin.entities-rewards.index');
    }

    public function show(EntitiesReward $entitiesReward)
    {
        abort_if(Gate::denies('entities_reward_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesReward->load('entity', 'reward');

        return view('admin.entitiesRewards.show', compact('entitiesReward'));
    }

    public function destroy(EntitiesReward $entitiesReward)
    {
        abort_if(Gate::denies('entities_reward_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entitiesReward->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntitiesRewardRequest $request)
    {
        $entitiesRewards = EntitiesReward::find(request('ids'));

        foreach ($entitiesRewards as $entitiesReward) {
            $entitiesReward->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
