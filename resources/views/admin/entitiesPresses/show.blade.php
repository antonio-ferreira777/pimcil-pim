@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.entitiesPress.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-presses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.id') }}
                        </th>
                        <td>
                            {{ $entitiesPress->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.entity') }}
                        </th>
                        <td>
                            {{ $entitiesPress->entity->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.name') }}
                        </th>
                        <td>
                            {{ $entitiesPress->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.date') }}
                        </th>
                        <td>
                            {{ $entitiesPress->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.comment') }}
                        </th>
                        <td>
                            {{ $entitiesPress->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.url') }}
                        </th>
                        <td>
                            {{ $entitiesPress->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesPress.fields.status') }}
                        </th>
                        <td>
                            {{ $entitiesPress->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-presses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection