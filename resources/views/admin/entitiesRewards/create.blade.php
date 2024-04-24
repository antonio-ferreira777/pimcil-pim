@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.entitiesReward.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-rewards.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesReward.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ old('entity_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reward_id">{{ trans('cruds.entitiesReward.fields.reward') }}</label>
                <select class="form-control select2 {{ $errors->has('reward') ? 'is-invalid' : '' }}" name="reward_id" id="reward_id">
                    @foreach($rewards as $id => $entry)
                        <option value="{{ $id }}" {{ old('reward_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reward'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reward') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.reward_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.entitiesReward.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', '') }}" step="1" required>
                @if($errors->has('year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.entitiesReward.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="points">{{ trans('cruds.entitiesReward.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', '') }}" step="0.01">
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesReward.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.entitiesReward.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment') }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
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