@can('product_field_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-fields.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productField.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.productField.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-productProductFields">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productField.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productField.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.pim.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.productField.fields.field') }}
                        </th>
                        <th>
                            {{ trans('cruds.productField.fields.field_value') }}
                        </th>
                        <th>
                            {{ trans('cruds.productField.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productFields as $key => $productField)
                        <tr data-entry-id="{{ $productField->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productField->id ?? '' }}
                            </td>
                            <td>
                                {{ $productField->product->ean ?? '' }}
                            </td>
                            <td>
                                {{ $productField->product->name ?? '' }}
                            </td>
                            <td>
                                {{ $productField->field->name ?? '' }}
                            </td>
                            <td>
                                {{ $productField->field_value ?? '' }}
                            </td>
                            <td>
                                {{ $productField->status->name ?? '' }}
                            </td>
                            <td>
                                @can('product_field_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-fields.show', $productField->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_field_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-fields.edit', $productField->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_field_delete')
                                    <form action="{{ route('admin.product-fields.destroy', $productField->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_field_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-fields.massDestroy') }}",
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
  let table = $('.datatable-productProductFields:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection