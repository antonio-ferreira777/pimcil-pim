@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.entitiesVersioning.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities-versionings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.entitiesVersioning.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entry)
                        <option value="{{ $id }}" {{ old('entity_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesVersioning.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="values">{{ trans('cruds.entitiesVersioning.fields.values') }}</label>
                <textarea class="form-control {{ $errors->has('values') ? 'is-invalid' : '' }}" name="values" id="values" required>{{ old('values') }}</textarea>
                @if($errors->has('values'))
                    <span class="text-danger">{{ $errors->first('values') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entitiesVersioning.fields.values_helper') }}</span>
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