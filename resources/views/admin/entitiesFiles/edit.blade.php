@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.entitiesFile.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-files.update", [$entitiesFile->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesFile.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $entitiesFile->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file_id">{{ trans('cruds.entitiesFile.fields.file') }}</label>
                <select class="form-control select2 {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file_id" id="file_id" required>
                    @foreach($files as $id => $entry)
                        <option value="{{ $id }}" {{ (old('file_id') ? old('file_id') : $entitiesFile->file->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="display_order">{{ trans('cruds.entitiesFile.fields.display_order') }}</label>
                <input class="form-control {{ $errors->has('display_order') ? 'is-invalid' : '' }}" type="number" name="display_order" id="display_order" value="{{ old('display_order', $entitiesFile->display_order) }}" step="1">
                @if($errors->has('display_order'))
                    <span class="text-danger">{{ $errors->first('display_order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.display_order_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_default') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_default" id="is_default" value="1" {{ $entitiesFile->is_default || old('is_default', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="is_default">{{ trans('cruds.entitiesFile.fields.is_default') }}</label>
                </div>
                @if($errors->has('is_default'))
                    <span class="text-danger">{{ $errors->first('is_default') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.is_default_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('to_use') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="to_use" id="to_use" value="1" {{ $entitiesFile->to_use || old('to_use', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="to_use">{{ trans('cruds.entitiesFile.fields.to_use') }}</label>
                </div>
                @if($errors->has('to_use'))
                    <span class="text-danger">{{ $errors->first('to_use') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.to_use_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.entitiesFile.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $entitiesFile->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.status_helper') }}</span>
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