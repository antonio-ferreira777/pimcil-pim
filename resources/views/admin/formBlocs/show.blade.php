@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.formBloc.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.form-blocs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.formBloc.fields.id') }}
                        </th>
                        <td>
                            {{ $formBloc->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formBloc.fields.name') }}
                        </th>
                        <td>
                            {{ $formBloc->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.formBloc.fields.status') }}
                        </th>
                        <td>
                            {{ $formBloc->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.form-blocs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#form_bloc_fields" role="tab" data-toggle="tab">
                {{ trans('cruds.field.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="form_bloc_fields">
            @includeIf('admin.formBlocs.relationships.formBlocFields', ['fields' => $formBloc->formBlocFields])
        </div>
    </div>
</div>

@endsection