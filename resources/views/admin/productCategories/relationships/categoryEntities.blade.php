@can('entity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.entities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.entity.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.entity.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-categoryEntities">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.ref') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.ean') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.language') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.valid_from') }}
                        </th>
                        <th>
                            {{ trans('cruds.entity.fields.valid_to') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $key => $entity)
                        <tr data-entry-id="{{ $entity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $entity->id ?? '' }}
                            </td>
                            <td>
                                {{ $entity->ref ?? '' }}
                            </td>
                            <td>
                                {{ $entity->ean ?? '' }}
                            </td>
                            <td>
                                {{ $entity->name ?? '' }}
                            </td>
                            <td>
                                @foreach($entity->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $entity->language->name ?? '' }}
                            </td>
                            <td>
                                {{ $entity->valid_from ?? '' }}
                            </td>
                            <td>
                                {{ $entity->valid_to ?? '' }}
                            </td>
                            <td>
                                @can('entity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.entities.show', $entity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('entity_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.entities.edit', $entity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('entity_delete')
                                    <form action="{{ route('admin.entities.destroy', $entity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('entity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.entities.massDestroy') }}",
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
  let table = $('.datatable-categoryEntities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection