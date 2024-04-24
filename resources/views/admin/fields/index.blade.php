@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Field">
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
                        {{ trans('cruds.field.fields.data_source') }}
                    </th>
                    <th>
                        {{ trans('cruds.field.fields.status') }}
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
@can('field_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fields.massDestroy') }}",
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
    ajax: "{{ route('admin.fields.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'type', name: 'type' },
{ data: 'default', name: 'default' },
{ data: 'nullable', name: 'nullable' },
{ data: 'form_bloc', name: 'form_blocs.name' },
{ data: 'taxonomy_id_parent', name: 'taxonomy.id_parent' },
{ data: 'channel_name', name: 'channel.name' },
{ data: 'channels_transversality', name: 'channels_transversality' },
{ data: 'language_transversality', name: 'language_transversality' },
{ data: 'display_order', name: 'display_order' },
{ data: 'data_source', name: 'data_source' },
{ data: 'status_name', name: 'status.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Field').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection