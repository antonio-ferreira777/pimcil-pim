@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.suggest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suggests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.suggest.fields.id') }}
                        </th>
                        <td>
                            {{ $suggest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggest.fields.name') }}
                        </th>
                        <td>
                            {{ $suggest->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggest.fields.slug') }}
                        </th>
                        <td>
                            {{ $suggest->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggest.fields.editable') }}
                        </th>
                        <td>
                            {{ $suggest->editable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggest.fields.status') }}
                        </th>
                        <td>
                            {{ $suggest->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suggests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection