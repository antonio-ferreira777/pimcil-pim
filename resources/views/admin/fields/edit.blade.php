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
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.field.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $field->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
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
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default">{{ trans('cruds.field.fields.default') }}</label>
                <input class="form-control {{ $errors->has('default') ? 'is-invalid' : '' }}" type="text" name="default" id="default" value="{{ old('default', $field->default) }}">
                @if($errors->has('default'))
                    <span class="text-danger">{{ $errors->first('default') }}</span>
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
                    <span class="text-danger">{{ $errors->first('nullable') }}</span>
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
                    <span class="text-danger">{{ $errors->first('form_blocs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.form_bloc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="taxonomies">{{ trans('cruds.field.fields.taxonomy') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('taxonomies') ? 'is-invalid' : '' }}" name="taxonomies[]" id="taxonomies" multiple>
                    @foreach($taxonomies as $id => $taxonomy)
                        <option value="{{ $id }}" {{ (in_array($id, old('taxonomies', [])) || $field->taxonomies->contains($id)) ? 'selected' : '' }}>{{ $taxonomy }}</option>
                    @endforeach
                </select>
                @if($errors->has('taxonomies'))
                    <span class="text-danger">{{ $errors->first('taxonomies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.taxonomy_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="channels">{{ trans('cruds.field.fields.channels') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('channels') ? 'is-invalid' : '' }}" name="channels[]" id="channels" multiple>
                    @foreach($channels as $id => $channel)
                        <option value="{{ $id }}" {{ (in_array($id, old('channels', [])) || $field->channels->contains($id)) ? 'selected' : '' }}>{{ $channel }}</option>
                    @endforeach
                </select>
                @if($errors->has('channels'))
                    <span class="text-danger">{{ $errors->first('channels') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.channels_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="languages">{{ trans('cruds.field.fields.languages') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('languages') ? 'is-invalid' : '' }}" name="languages[]" id="languages" multiple>
                    @foreach($languages as $id => $language)
                        <option value="{{ $id }}" {{ (in_array($id, old('languages', [])) || $field->languages->contains($id)) ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>
                @if($errors->has('languages'))
                    <span class="text-danger">{{ $errors->first('languages') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.languages_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="countries">{{ trans('cruds.field.fields.countries') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('countries') ? 'is-invalid' : '' }}" name="countries[]" id="countries" multiple>
                    @foreach($countries as $id => $country)
                        <option value="{{ $id }}" {{ (in_array($id, old('countries', [])) || $field->countries->contains($id)) ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                @if($errors->has('countries'))
                    <span class="text-danger">{{ $errors->first('countries') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.countries_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="entities">{{ trans('cruds.field.fields.entities') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('entities') ? 'is-invalid' : '' }}" name="entities[]" id="entities" multiple>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ (in_array($id, old('entities', [])) || $field->entities->contains($id)) ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entities'))
                    <span class="text-danger">{{ $errors->first('entities') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.entities_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('taxonomy_transversality') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="taxonomy_transversality" value="0">
                    <input class="form-check-input" type="checkbox" name="taxonomy_transversality" id="taxonomy_transversality" value="1" {{ $field->taxonomy_transversality || old('taxonomy_transversality', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="taxonomy_transversality">{{ trans('cruds.field.fields.taxonomy_transversality') }}</label>
                </div>
                @if($errors->has('taxonomy_transversality'))
                    <span class="text-danger">{{ $errors->first('taxonomy_transversality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.taxonomy_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('channels_transversality') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="channels_transversality" value="0">
                    <input class="form-check-input" type="checkbox" name="channels_transversality" id="channels_transversality" value="1" {{ $field->channels_transversality || old('channels_transversality', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="channels_transversality">{{ trans('cruds.field.fields.channels_transversality') }}</label>
                </div>
                @if($errors->has('channels_transversality'))
                    <span class="text-danger">{{ $errors->first('channels_transversality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.channels_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('language_transversality') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="language_transversality" value="0">
                    <input class="form-check-input" type="checkbox" name="language_transversality" id="language_transversality" value="1" {{ $field->language_transversality || old('language_transversality', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="language_transversality">{{ trans('cruds.field.fields.language_transversality') }}</label>
                </div>
                @if($errors->has('language_transversality'))
                    <span class="text-danger">{{ $errors->first('language_transversality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.language_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('countries_transversality') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="countries_transversality" value="0">
                    <input class="form-check-input" type="checkbox" name="countries_transversality" id="countries_transversality" value="1" {{ $field->countries_transversality || old('countries_transversality', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="countries_transversality">{{ trans('cruds.field.fields.countries_transversality') }}</label>
                </div>
                @if($errors->has('countries_transversality'))
                    <span class="text-danger">{{ $errors->first('countries_transversality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.countries_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('entities_transversality') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="entities_transversality" value="0">
                    <input class="form-check-input" type="checkbox" name="entities_transversality" id="entities_transversality" value="1" {{ $field->entities_transversality || old('entities_transversality', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="entities_transversality">{{ trans('cruds.field.fields.entities_transversality') }}</label>
                </div>
                @if($errors->has('entities_transversality'))
                    <span class="text-danger">{{ $errors->first('entities_transversality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.entities_transversality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="display_order">{{ trans('cruds.field.fields.display_order') }}</label>
                <input class="form-control {{ $errors->has('display_order') ? 'is-invalid' : '' }}" type="number" name="display_order" id="display_order" value="{{ old('display_order', $field->display_order) }}" step="1">
                @if($errors->has('display_order'))
                    <span class="text-danger">{{ $errors->first('display_order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.display_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_source">{{ trans('cruds.field.fields.data_source') }}</label>
                <input class="form-control {{ $errors->has('data_source') ? 'is-invalid' : '' }}" type="text" name="data_source" id="data_source" value="{{ old('data_source', $field->data_source) }}">
                @if($errors->has('data_source'))
                    <span class="text-danger">{{ $errors->first('data_source') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.field.fields.data_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.field.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $field->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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