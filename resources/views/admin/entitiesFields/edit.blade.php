@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.entitiesField.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-fields.update", [$entitiesField->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesField.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $entitiesField->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_id">{{ trans('cruds.entitiesField.fields.field') }}</label>
                <select class="form-control select2 {{ $errors->has('field') ? 'is-invalid' : '' }}" name="field_id" id="field_id" required>
                    @foreach($fields as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_id') ? old('field_id') : $entitiesField->field->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field'))
                    <span class="text-danger">{{ $errors->first('field') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.field_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_value">{{ trans('cruds.entitiesField.fields.field_value') }}</label>
                <textarea class="form-control {{ $errors->has('field_value') ? 'is-invalid' : '' }}" name="field_value" id="field_value">{{ old('field_value', $entitiesField->field_value) }}</textarea>
                @if($errors->has('field_value'))
                    <span class="text-danger">{{ $errors->first('field_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.field_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="language_id">{{ trans('cruds.entitiesField.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id">
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('language_id') ? old('language_id') : $entitiesField->language->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <span class="text-danger">{{ $errors->first('language') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesField.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.entitiesField.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $entitiesField->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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