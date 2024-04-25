@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.producer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.producers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.id') }}
                        </th>
                        <td>
                            {{ $producer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.name') }}
                        </th>
                        <td>
                            {{ $producer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.address') }}
                        </th>
                        <td>
                            {{ $producer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.zip_code') }}
                        </th>
                        <td>
                            {{ $producer->zip_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.city') }}
                        </th>
                        <td>
                            {{ $producer->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.country') }}
                        </th>
                        <td>
                            {{ $producer->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.url') }}
                        </th>
                        <td>
                            {{ $producer->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.logo') }}
                        </th>
                        <td>
                            @if($producer->logo)
                                <a href="{{ $producer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $producer->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.email') }}
                        </th>
                        <td>
                            {{ $producer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.phone') }}
                        </th>
                        <td>
                            {{ $producer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.fax') }}
                        </th>
                        <td>
                            {{ $producer->fax }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.producer.fields.vat') }}
                        </th>
                        <td>
                            {{ $producer->vat }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.producers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection