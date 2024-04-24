@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.winemaker.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.winemakers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.winemaker.fields.id') }}
                        </th>
                        <td>
                            {{ $winemaker->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winemaker.fields.name') }}
                        </th>
                        <td>
                            {{ $winemaker->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winemaker.fields.description') }}
                        </th>
                        <td>
                            {{ $winemaker->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winemaker.fields.pictures') }}
                        </th>
                        <td>
                            @foreach($winemaker->pictures as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winemaker.fields.status') }}
                        </th>
                        <td>
                            {{ $winemaker->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.winemakers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection