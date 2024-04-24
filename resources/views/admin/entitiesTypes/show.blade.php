@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.entitiesType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesType.fields.id') }}
                        </th>
                        <td>
                            {{ $entitiesType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesType.fields.name') }}
                        </th>
                        <td>
                            {{ $entitiesType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesType.fields.slug') }}
                        </th>
                        <td>
                            {{ $entitiesType->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entitiesType.fields.status') }}
                        </th>
                        <td>
                            {{ $entitiesType->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection