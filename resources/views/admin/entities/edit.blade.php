@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.entity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities.update", [$entity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="ref">{{ trans('cruds.entity.fields.ref') }}</label>
                <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ old('ref', $entity->ref) }}" required>
                @if($errors->has('ref'))
                    <span class="text-danger">{{ $errors->first('ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ean">{{ trans('cruds.entity.fields.ean') }}</label>
                <input class="form-control {{ $errors->has('ean') ? 'is-invalid' : '' }}" type="text" name="ean" id="ean" value="{{ old('ean', $entity->ean) }}">
                @if($errors->has('ean'))
                    <span class="text-danger">{{ $errors->first('ean') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.ean_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.entity.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $entity->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="taxonomy_id">{{ trans('cruds.entity.fields.taxonomy') }}</label>
                <select class="form-control select2 {{ $errors->has('taxonomy') ? 'is-invalid' : '' }}" name="taxonomy_id" id="taxonomy_id" required>
                    @foreach($taxonomies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('taxonomy_id') ? old('taxonomy_id') : $entity->taxonomy->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('taxonomy'))
                    <span class="text-danger">{{ $errors->first('taxonomy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.taxonomy_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type_id">{{ trans('cruds.entity.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $entity->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="language_id">{{ trans('cruds.entity.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id" required>
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('language_id') ? old('language_id') : $entity->language->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <span class="text-danger">{{ $errors->first('language') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valid_from">{{ trans('cruds.entity.fields.valid_from') }}</label>
                <input class="form-control datetime {{ $errors->has('valid_from') ? 'is-invalid' : '' }}" type="text" name="valid_from" id="valid_from" value="{{ old('valid_from', $entity->valid_from) }}">
                @if($errors->has('valid_from'))
                    <span class="text-danger">{{ $errors->first('valid_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.valid_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valid_to">{{ trans('cruds.entity.fields.valid_to') }}</label>
                <input class="form-control datetime {{ $errors->has('valid_to') ? 'is-invalid' : '' }}" type="text" name="valid_to" id="valid_to" value="{{ old('valid_to', $entity->valid_to) }}">
                @if($errors->has('valid_to'))
                    <span class="text-danger">{{ $errors->first('valid_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.valid_to_helper') }}</span>
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