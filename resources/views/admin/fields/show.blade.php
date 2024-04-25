@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.field.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.id') }}
                        </th>
                        <td>
                            {{ $field->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.name') }}
                        </th>
                        <td>
                            {{ $field->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.description') }}
                        </th>
                        <td>
                            {{ $field->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Field::TYPE_SELECT[$field->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.default') }}
                        </th>
                        <td>
                            {{ $field->default }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.nullable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $field->nullable ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.form_bloc') }}
                        </th>
                        <td>
                            @foreach($field->form_blocs as $key => $form_bloc)
                                <span class="label label-info">{{ $form_bloc->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.taxonomy') }}
                        </th>
                        <td>
                            @foreach($field->taxonomies as $key => $taxonomy)
                                <span class="label label-info">{{ $taxonomy->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.channels') }}
                        </th>
                        <td>
                            @foreach($field->channels as $key => $channels)
                                <span class="label label-info">{{ $channels->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.languages') }}
                        </th>
                        <td>
                            @foreach($field->languages as $key => $languages)
                                <span class="label label-info">{{ $languages->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.countries') }}
                        </th>
                        <td>
                            @foreach($field->countries as $key => $countries)
                                <span class="label label-info">{{ $countries->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.entities') }}
                        </th>
                        <td>
                            @foreach($field->entities as $key => $entities)
                                <span class="label label-info">{{ $entities->ref }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.taxonomy_transversality') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $field->taxonomy_transversality ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.channels_transversality') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $field->channels_transversality ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.language_transversality') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $field->language_transversality ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.countries_transversality') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $field->countries_transversality ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.entities_transversality') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $field->entities_transversality ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.display_order') }}
                        </th>
                        <td>
                            {{ $field->display_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.data_source') }}
                        </th>
                        <td>
                            {{ $field->data_source }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.status') }}
                        </th>
                        <td>
                            {{ $field->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection