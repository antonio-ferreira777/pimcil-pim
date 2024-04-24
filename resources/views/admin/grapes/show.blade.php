@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.grape.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.grapes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.grape.fields.id') }}
                        </th>
                        <td>
                            {{ $grape->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.grape.fields.name') }}
                        </th>
                        <td>
                            {{ $grape->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.grape.fields.synonyms') }}
                        </th>
                        <td>
                            {{ $grape->synonyms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.grape.fields.description') }}
                        </th>
                        <td>
                            {{ $grape->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.grape.fields.pictures') }}
                        </th>
                        <td>
                            @foreach($grape->pictures as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.grape.fields.status') }}
                        </th>
                        <td>
                            {{ $grape->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.grapes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection