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
                            {{ trans('cruds.suggestsValue.fields.description') }}
                        </th>
                        <td>
                            {{ $suggestsValue->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.picto') }}
                        </th>
                        <td>
                            @if($suggestsValue->picto)
                                <a href="{{ $suggestsValue->picto->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $suggestsValue->picto->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.files') }}
                        </th>
                        <td>
                            @foreach($suggestsValue->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.pictures') }}
                        </th>
                        <td>
                            @foreach($suggestsValue->pictures as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.table_link') }}
                        </th>
                        <td>
                            {{ $suggestsValue->table_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.table_link_value') }}
                        </th>
                        <td>
                            {{ $suggestsValue->table_link_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suggestsValue.fields.status') }}
                        </th>
                        <td>
                            {{ $suggestsValue->status->name ?? '' }}
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