@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.entitiesFile.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-files.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.id') }}
                        </th>
                        <td>
                            {{ $entitiesFile->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.entity') }}
                        </th>
                        <td>
                            {{ $entitiesFile->entity->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.file') }}
                        </th>
                        <td>
                            {{ $entitiesFile->file->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.display_order') }}
                        </th>
                        <td>
                            {{ $entitiesFile->display_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.is_default') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $entitiesFile->is_default ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.to_use') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $entitiesFile->to_use ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesFile.fields.status') }}
                        </th>
                        <td>
                            {{ $entitiesFile->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-files.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection