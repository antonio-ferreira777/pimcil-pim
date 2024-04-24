@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.entitiesFile.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-files.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesFile.fields.entity') }}</label>
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
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file_id">{{ trans('cruds.entitiesFile.fields.file') }}</label>
                <select class="form-control select2 {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file_id" id="file_id" required>
                    @foreach($files as $id => $entry)
                        <option value="{{ $id }}" {{ old('file_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="display_order">{{ trans('cruds.entitiesFile.fields.display_order') }}</label>
                <input class="form-control {{ $errors->has('display_order') ? 'is-invalid' : '' }}" type="number" name="display_order" id="display_order" value="{{ old('display_order', '1') }}" step="1">
                @if($errors->has('display_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('display_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.display_order_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_default') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_default" id="is_default" value="1" required {{ old('is_default', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_default">{{ trans('cruds.entitiesFile.fields.is_default') }}</label>
                </div>
                @if($errors->has('is_default'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_default') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.is_default_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('to_use') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="to_use" id="to_use" value="1" required {{ old('to_use', 0) == 1 || old('to_use') === null ? 'checked' : '' }}>
                    <label class="required form-check-label" for="to_use">{{ trans('cruds.entitiesFile.fields.to_use') }}</label>
                </div>
                @if($errors->has('to_use'))
                    <div class="invalid-feedback">
                        {{ $errors->first('to_use') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesFile.fields.to_use_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.entitiesFile.fields.status') }}</label>
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