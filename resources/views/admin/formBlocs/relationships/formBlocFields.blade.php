@can('field_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fields.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.field.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.field.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-formBlocFields">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.field.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.default') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.nullable') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.form_bloc') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.taxonomy') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.channel') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.channels_transversality') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.language_transversality') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.display_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.field.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fields as $key => $field)
                        <tr data-entry-id="{{ $field->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $field->id ?? '' }}
                            </td>
                            <td>
                                {{ $field->name ?? '' }}
                            </td>
                            <td>
                                {{ $field->description ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Field::TYPE_SELECT[$field->type] ?? '' }}
                            </td>
                            <td>
                                {{ $field->default ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $field->nullable ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $field->nullable ? 'checked' : '' }}>
                            </td>
                            <td>
                                @foreach($field->form_blocs as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $field->taxonomy->id_parent ?? '' }}
                            </td>
                            <td>
                                {{ $field->channel->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $field->channels_transversality ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $field->channels_transversality ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $field->language_transversality ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $field->language_transversality ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $field->display_order ?? '' }}
                            </td>
                            <td>
                                {{ $field->status->name ?? '' }}
                            </td>
                            <td>
                                @can('field_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.fields.show', $field->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('field_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.fields.edit', $field->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('field_delete')
                                    <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('field_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fields.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-formBlocFields:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection