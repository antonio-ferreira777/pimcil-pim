@extends('layouts.admin')
@section('content')
@can('entities_reward_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.entities-rewards.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.entitiesReward.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.entitiesReward.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EntitiesReward">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.reward') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.year') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.points') }}
                    </th>
                    <th>
                        {{ trans('cruds.entitiesReward.fields.comment') }}
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
@can('entities_reward_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.entities-rewards.massDestroy') }}",
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
    ajax: "{{ route('admin.entities-rewards.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'entity_ref', name: 'entity.ref' },
{ data: 'reward_name', name: 'reward.name' },
{ data: 'year', name: 'year' },
{ data: 'date', name: 'date' },
{ data: 'points', name: 'points' },
{ data: 'comment', name: 'comment' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-EntitiesReward').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection