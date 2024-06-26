@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.region.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.regions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.id') }}
                        </th>
                        <td>
                            {{ $region->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.id_parent') }}
                        </th>
                        <td>
                            {{ $region->id_parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.name') }}
                        </th>
                        <td>
                            {{ $region->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.country') }}
                        </th>
                        <td>
                            {{ $region->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.wine_commissions') }}
                        </th>
                        <td>
                            {{ $region->wine_commissions }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.description') }}
                        </th>
                        <td>
                            {{ $region->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.regions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection