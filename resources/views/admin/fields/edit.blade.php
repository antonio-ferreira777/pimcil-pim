@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.field.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fields.update", [$field->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.field.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $field->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.field.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $field->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.field.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Field::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $field->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default">{{ trans('cruds.field.fields.default') }}</label>
                <input class="form-control {{ $errors->has('default') ? 'is-invalid' : '' }}" type="text" name="default" id="default" value="{{ old('default', $field->default) }}">
                @if($errors->has('default'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.default_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('nullable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="nullable" value="0">
                    <input class="form-check-input" type="checkbox" name="nullable" id="nullable" value="1" {{ $field->nullable || old('nullable', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="nullable">{{ trans('cruds.field.fields.nullable') }}</label>
                </div>
                @if($errors->has('nullable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nullable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.nullable_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="form_blocs">{{ trans('cruds.field.fields.form_bloc') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('form_blocs') ? 'is-invalid' : '' }}" name="form_blocs[]" id="form_blocs" multiple required>
                    @foreach($form_blocs as $id => $form_bloc)
                        <option value="{{ $id }}" {{ (in_array($id, old('form_blocs', [])) || $field->form_blocs->contains($id)) ? 'selected' : '' }}>{{ $form_bloc }}</option>
                    @endforeach
                </select>
                @if($errors->has('form_blocs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('form_blocs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.form_bloc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="taxonomy_id">{{ trans('cruds.field.fields.taxonomy') }}</label>
                <select class="form-control select2 {{ $errors->has('taxonomy') ? 'is-invalid' : '' }}" name="taxonomy_id" id="taxonomy_id">
                    @foreach($taxonomies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('taxonomy_id') ? old('taxonomy_id') : $field->taxonomy->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('taxonomy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('taxonomy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.taxonomy_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="channel_id">{{ trans('cruds.field.fields.channel') }}</label>
                <select class="form-control select2 {{ $errors->has('channel') ? 'is-invalid' : '' }}" name="channel_id" id="channel_id">
                    @foreach($channels as $id => $entry)
                        <option value="{{ $id }}" {{ (old('channel_id') ? old('channel_id') : $field->channel->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('channel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('channel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.channel_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('channels_transversality') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="channels_transversality" id="channels_transversality" value="1" {{ $field->channels_transversality || old('channels_transversality', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="channels_transversality">{{ trans('cruds.field.fields.channels_transversality') }}</label>
                </div>
                @if($errors->has('channels_transversality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('channels_transversality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.channels_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('language_transversality') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="language_transversality" id="language_transversality" value="1" {{ $field->language_transversality || old('language_transversality', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="language_transversality">{{ trans('cruds.field.fields.language_transversality') }}</label>
                </div>
                @if($errors->has('language_transversality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('language_transversality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.language_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.field.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $field->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.status_helper') }}</span>
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