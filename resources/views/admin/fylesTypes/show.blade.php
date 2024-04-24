@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fylesType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fyles-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fylesType.fields.id') }}
                        </th>
                        <td>
                            {{ $fylesType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fylesType.fields.name') }}
                        </th>
                        <td>
                            {{ $fylesType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fylesType.fields.slug') }}
                        </th>
                        <td>
                            {{ $fylesType->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fylesType.fields.status') }}
                        </th>
                        <td>
                            {{ $fylesType->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fyles-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection