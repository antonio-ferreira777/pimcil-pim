@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.file.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.files.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.id') }}
                        </th>
                        <td>
                            {{ $file->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.file') }}
                        </th>
                        <td>
                            @foreach($file->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.name') }}
                        </th>
                        <td>
                            {{ $file->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.path') }}
                        </th>
                        <td>
                            @foreach($file->path as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.ext') }}
                        </th>
                        <td>
                            {{ $file->ext }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.size') }}
                        </th>
                        <td>
                            {{ $file->size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.type') }}
                        </th>
                        <td>
                            {{ $file->type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.status') }}
                        </th>
                        <td>
                            {{ $file->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.files.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection