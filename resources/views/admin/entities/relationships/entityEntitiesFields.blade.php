@can('entities_field_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.entities-fields.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.entitiesField.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.entitiesField.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-entityEntitiesFields">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.entitiesField.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.entitiesField.fields.entity') }}
                        </th>
                        <th>
                            {{ trans('cruds.entitiesField.fields.field') }}
                        </th>
                        <th>
                            {{ trans('cruds.entitiesField.fields.field_value') }}
                        </th>
                        <th>
                            {{ trans('cruds.entitiesField.fields.language') }}
                        </th>
                        <th>
                            {{ trans('cruds.entitiesField.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entitiesFields as $key => $entitiesField)
                        <tr data-entry-id="{{ $entitiesField->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $entitiesField->id ?? '' }}
                            </td>
                            <td>
                                {{ $entitiesField->entity->ref ?? '' }}
                            </td>
                            <td>
                                {{ $entitiesField->field->name ?? '' }}
                            </td>
                            <td>
                                {{ $entitiesField->field_value ?? '' }}
                            </td>
                            <td>
                                {{ $entitiesField->language->name ?? '' }}
                            </td>
                            <td>
                                {{ $entitiesField->status->name ?? '' }}
                            </td>
                            <td>
                                @can('entities_field_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.entities-fields.show', $entitiesField->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('entities_field_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.entities-fields.edit', $entitiesField->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('entities_field_delete')
                                    <form action="{{ route('admin.entities-fields.destroy', $entitiesField->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('entities_field_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.entities-fields.massDestroy') }}",
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
  let table = $('.datatable-entityEntitiesFields:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection