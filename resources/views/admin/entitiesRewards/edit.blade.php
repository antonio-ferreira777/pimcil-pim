@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.entitiesReward.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-rewards.update", [$entitiesReward->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesReward.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $entitiesReward->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reward_id">{{ trans('cruds.entitiesReward.fields.reward') }}</label>
                <select class="form-control select2 {{ $errors->has('reward') ? 'is-invalid' : '' }}" name="reward_id" id="reward_id">
                    @foreach($rewards as $id => $entry)
                        <option value="{{ $id }}" {{ (old('reward_id') ? old('reward_id') : $entitiesReward->reward->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reward'))
                    <span class="text-danger">{{ $errors->first('reward') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.reward_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.entitiesReward.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', $entitiesReward->year) }}" step="1" required>
                @if($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.entitiesReward.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $entitiesReward->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points">{{ trans('cruds.entitiesReward.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', $entitiesReward->points) }}" step="0.01">
                @if($errors->has('points'))
                    <span class="text-danger">{{ $errors->first('points') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.entitiesReward.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $entitiesReward->comment) }}</textarea>
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection