@extends('layouts.admin')
@section('content')
@can('producer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.producers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.producer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.producer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Producer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.zip_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.fax') }}
                        </th>
                        <th>
                            {{ trans('cruds.producer.fields.vat') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producers as $key => $producer)
                        <tr data-entry-id="{{ $producer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $producer->id ?? '' }}
                            </td>
                            <td>
                                {{ $producer->name ?? '' }}
                            </td>
                            <td>
                                {{ $producer->address ?? '' }}
                            </td>
                            <td>
                                {{ $producer->zip_code ?? '' }}
                            </td>
                            <td>
                                {{ $producer->city ?? '' }}
                            </td>
                            <td>
                                {{ $producer->country->name ?? '' }}
                            </td>
                            <td>
                                {{ $producer->url ?? '' }}
                            </td>
                            <td>
                                @if($producer->logo)
                                    <a href="{{ $producer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $producer->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $producer->email ?? '' }}
                            </td>
                            <td>
                                {{ $producer->phone ?? '' }}
                            </td>
                            <td>
                                {{ $producer->fax ?? '' }}
                            </td>
                            <td>
                                {{ $producer->vat ?? '' }}
                            </td>
                            <td>
                                @can('producer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.producers.show', $producer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('producer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.producers.edit', $producer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('producer_delete')
                                    <form action="{{ route('admin.producers.destroy', $producer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('producer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.producers.massDestroy') }}",
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
  let table = $('.datatable-Producer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection