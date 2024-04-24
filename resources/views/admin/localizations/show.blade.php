@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.localization.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.localizations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.localization.fields.id') }}
                        </th>
                        <td>
                            {{ $localization->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localization.fields.data_table') }}
                        </th>
                        <td>
                            {{ $localization->data_table }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localization.fields.data') }}
                        </th>
                        <td>
                            {{ $localization->data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localization.fields.data_value') }}
                        </th>
                        <td>
                            {{ $localization->data_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localization.fields.language') }}
                        </th>
                        <td>
                            {{ $localization->language->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.localizations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection