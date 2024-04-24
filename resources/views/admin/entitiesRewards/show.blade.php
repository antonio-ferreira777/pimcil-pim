@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.entitiesReward.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-rewards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.id') }}
                        </th>
                        <td>
                            {{ $entitiesReward->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.entity') }}
                        </th>
                        <td>
                            {{ $entitiesReward->entity->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.reward') }}
                        </th>
                        <td>
                            {{ $entitiesReward->reward->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.year') }}
                        </th>
                        <td>
                            {{ $entitiesReward->year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.date') }}
                        </th>
                        <td>
                            {{ $entitiesReward->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.points') }}
                        </th>
                        <td>
                            {{ $entitiesReward->points }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesReward.fields.comment') }}
                        </th>
                        <td>
                            {{ $entitiesReward->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-rewards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection