@extends('layouts.admin')
@section('content')
@can('suggests_value_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.suggests-values.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.suggestsValue.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.suggestsValue.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SuggestsValue">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.suggest') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.value') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.language') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.picto') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.files') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.pictures') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.table_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.table_link_value') }}
                    </th>
                    <th>
                        {{ trans('cruds.suggestsValue.fields.status') }}
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
@can('suggests_value_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.suggests-values.massDestroy') }}",
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
    ajax: "{{ route('admin.suggests-values.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'suggest_name', name: 'suggest.name' },
{ data: 'value', name: 'value' },
{ data: 'language_name', name: 'language.name' },
{ data: 'country_name', name: 'country.name' },
{ data: 'description', name: 'description' },
{ data: 'picto', name: 'picto', sortable: false, searchable: false },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'pictures', name: 'pictures', sortable: false, searchable: false },
{ data: 'table_link', name: 'table_link' },
{ data: 'table_link_value', name: 'table_link_value' },
{ data: 'status_name', name: 'status.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SuggestsValue').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection