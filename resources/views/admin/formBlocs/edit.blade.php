@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.formBloc.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.form-blocs.update", [$formBloc->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.formBloc.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $formBloc->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formBloc.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="display_order">{{ trans('cruds.formBloc.fields.display_order') }}</label>
                <input class="form-control {{ $errors->has('display_order') ? 'is-invalid' : '' }}" type="number" name="display_order" id="display_order" value="{{ old('display_order', $formBloc->display_order) }}" step="1">
                @if($errors->has('display_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('display_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formBloc.fields.display_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.formBloc.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $formBloc->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.formBloc.fields.status_helper') }}</span>
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