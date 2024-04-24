@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.localization.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.localizations.update", [$localization->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="data_table">{{ trans('cruds.localization.fields.data_table') }}</label>
                <input class="form-control {{ $errors->has('data_table') ? 'is-invalid' : '' }}" type="text" name="data_table" id="data_table" value="{{ old('data_table', $localization->data_table) }}" required>
                @if($errors->has('data_table'))
                    <span class="text-danger">{{ $errors->first('data_table') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localization.fields.data_table_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data">{{ trans('cruds.localization.fields.data') }}</label>
                <input class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data', $localization->data) }}" required>
                @if($errors->has('data'))
                    <span class="text-danger">{{ $errors->first('data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localization.fields.data_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_value">{{ trans('cruds.localization.fields.data_value') }}</label>
                <input class="form-control {{ $errors->has('data_value') ? 'is-invalid' : '' }}" type="text" name="data_value" id="data_value" value="{{ old('data_value', $localization->data_value) }}" required>
                @if($errors->has('data_value'))
                    <span class="text-danger">{{ $errors->first('data_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localization.fields.data_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="language_id">{{ trans('cruds.localization.fields.language') }}</label>
                <select class="form-control select2 {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language_id" id="language_id" required>
                    @foreach($languages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('language_id') ? old('language_id') : $localization->language->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('language'))
                    <span class="text-danger">{{ $errors->first('language') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localization.fields.language_helper') }}</span>
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