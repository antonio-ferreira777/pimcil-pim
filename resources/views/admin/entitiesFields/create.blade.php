@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.entitiesField.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-fields.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesField.fields.entity') }}</label>
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
                <span class="help-block">{{ trans('cruds.entitiesField.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_id">{{ trans('cruds.entitiesField.fields.field') }}</label>
                <select class="form-control select2 {{ $errors->has('field') ? 'is-invalid' : '' }}" name="field_id" id="field_id" required>
                    @foreach($fields as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field'))
                    <div class="invalid-feedback">
                        {{ $errors->first('field') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.field_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_value">{{ trans('cruds.entitiesField.fields.field_value') }}</label>
                <textarea class="form-control {{ $errors->has('field_value') ? 'is-invalid' : '' }}" name="field_value" id="field_value">{{ old('field_value') }}</textarea>
                @if($errors->has('field_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('field_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.field_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="language_id">{{ trans('cruds.entitiesField.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id">
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ old('language_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.entitiesField.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.status_helper') }}</span>
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