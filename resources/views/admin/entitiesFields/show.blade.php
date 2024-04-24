@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.entitiesField.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesField.fields.id') }}
                        </th>
                        <td>
                            {{ $entitiesField->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesField.fields.entity') }}
                        </th>
                        <td>
                            {{ $entitiesField->entity->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesField.fields.field') }}
                        </th>
                        <td>
                            {{ $entitiesField->field->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesField.fields.field_value') }}
                        </th>
                        <td>
                            {{ $entitiesField->field_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesField.fields.language') }}
                        </th>
                        <td>
                            {{ $entitiesField->language->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesField.fields.status') }}
                        </th>
                        <td>
                            {{ $entitiesField->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection