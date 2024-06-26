@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.filesType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.files-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.filesType.fields.id') }}
                        </th>
                        <td>
                            {{ $filesType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.filesType.fields.name') }}
                        </th>
                        <td>
                            {{ $filesType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.filesType.fields.slug') }}
                        </th>
                        <td>
                            {{ $filesType->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.filesType.fields.status') }}
                        </th>
                        <td>
                            {{ $filesType->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.files-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection