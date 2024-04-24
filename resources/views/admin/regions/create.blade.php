@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.region.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.regions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_parent">{{ trans('cruds.region.fields.id_parent') }}</label>
                <input class="form-control {{ $errors->has('id_parent') ? 'is-invalid' : '' }}" type="number" name="id_parent" id="id_parent" value="{{ old('id_parent', '0') }}" step="1">
                @if($errors->has('id_parent'))
                    <span class="text-danger">{{ $errors->first('id_parent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.id_parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.region.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country_id">{{ trans('cruds.region.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wine_commissions">{{ trans('cruds.region.fields.wine_commissions') }}</label>
                <input class="form-control {{ $errors->has('wine_commissions') ? 'is-invalid' : '' }}" type="text" name="wine_commissions" id="wine_commissions" value="{{ old('wine_commissions', '') }}">
                @if($errors->has('wine_commissions'))
                    <span class="text-danger">{{ $errors->first('wine_commissions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.wine_commissions_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.region.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.description_helper') }}</span>
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