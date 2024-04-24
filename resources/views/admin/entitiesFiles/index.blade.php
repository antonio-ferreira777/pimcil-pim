@extends('layouts.admin')
@section('content')
@can('entities_file_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.entities-files.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.entitiesFile.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.entitiesFile.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EntitiesFile">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.entity.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.file') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.display_order') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.is_default') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.to_use') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesFile.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('entities_file_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.entities-files.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.entities-files.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'entity_ref', name: 'entity.ref' },
{ data: 'entity.name', name: 'entity.name' },
{ data: 'file_name', name: 'file.name' },
{ data: 'display_order', name: 'display_order' },
{ data: 'is_default', name: 'is_default' },
{ data: 'to_use', name: 'to_use' },
{ data: 'status_name', name: 'status.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-EntitiesFile').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection