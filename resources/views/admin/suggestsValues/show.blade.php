@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.suggestsValue.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suggests-values.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.id') }}
                        </th>
                        <td>
                            {{ $suggestsValue->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.suggest') }}
                        </th>
                        <td>
                            {{ $suggestsValue->suggest->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.value') }}
                        </th>
                        <td>
                            {{ $suggestsValue->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.language') }}
                        </th>
                        <td>
                            {{ $suggestsValue->language->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.country') }}
                        </th>
                        <td>
                            {{ $suggestsValue->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.status') }}
                        </th>
                        <td>
                            {{ $suggestsValue->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suggests-values.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection