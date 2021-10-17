@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bordereau_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bordereaus.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bordereau.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bordereau.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Bordereau">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bordereau.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bordereau.fields.team') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bordereau.fields.etat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bordereau.fields.note') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bordereaus as $key => $bordereau)
                                    <tr data-entry-id="{{ $bordereau->id }}">
                                        <td>
                                            {{ $bordereau->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bordereau->team->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Bordereau::ETAT_SELECT[$bordereau->etat] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bordereau->note ?? '' }}
                                        </td>
                                        <td>
                                            @can('bordereau_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bordereaus.show', $bordereau->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bordereau_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bordereaus.edit', $bordereau->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bordereau_delete')
                                                <form action="{{ route('frontend.bordereaus.destroy', $bordereau->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bordereau_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bordereaus.massDestroy') }}",
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
  let table = $('.datatable-Bordereau:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection