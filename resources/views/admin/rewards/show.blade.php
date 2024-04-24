@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reward.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rewards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.id') }}
                        </th>
                        <td>
                            {{ $reward->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.name') }}
                        </th>
                        <td>
                            {{ $reward->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.picto') }}
                        </th>
                        <td>
                            @if($reward->picto)
                                <a href="{{ $reward->picto->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $reward->picto->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.doc') }}
                        </th>
                        <td>
                            @foreach($reward->doc as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.link') }}
                        </th>
                        <td>
                            {{ $reward->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.status') }}
                        </th>
                        <td>
                            {{ $reward->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rewards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection