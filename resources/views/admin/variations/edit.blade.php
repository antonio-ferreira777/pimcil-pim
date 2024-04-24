@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.variation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.variations.update", [$variation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.variation.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $variation->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.variation.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_id">{{ trans('cruds.variation.fields.field') }}</label>
                <select class="form-control select2 {{ $errors->has('field') ? 'is-invalid' : '' }}" name="field_id" id="field_id">
                    @foreach($fields as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_id') ? old('field_id') : $variation->field->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field'))
                    <span class="text-danger">{{ $errors->first('field') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.variation.fields.field_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="master_entity_id">{{ trans('cruds.variation.fields.master_entity') }}</label>
                <select class="form-control select2 {{ $errors->has('master_entity') ? 'is-invalid' : '' }}" name="master_entity_id" id="master_entity_id" required>
                    @foreach($master_entities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('master_entity_id') ? old('master_entity_id') : $variation->master_entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('master_entity'))
                    <span class="text-danger">{{ $errors->first('master_entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.variation.fields.master_entity_helper') }}</span>
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