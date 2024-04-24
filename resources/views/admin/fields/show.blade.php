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
                            {{ $field->taxonomy->id_parent ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.field.fields.channel') }}
                        </th>
                        <td>
                            {{ $field->channel->name ?? '' }}
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