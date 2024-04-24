@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.entitiesPress.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-presses.update", [$entitiesPress->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesPress.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $entitiesPress->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesPress.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.entitiesPress.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $entitiesPress->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesPress.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.entitiesPress.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $entitiesPress->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesPress.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.entitiesPress.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $entitiesPress->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesPress.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.entitiesPress.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $entitiesPress->url) }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesPress.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.entitiesPress.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $entitiesPress->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesPress.fields.status_helper') }}</span>
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