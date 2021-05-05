@extends('layouts.admin')
@section('content')
@can('player_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.players.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.player.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.player.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Player">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.player.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.team') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.picture') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.prenom') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.tranche') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.cine') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.sexe') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.birthday_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.player.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Player::TRANCHE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Player::SEXE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Player::STATUS_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Player::CATEGORY_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($players as $key => $player)
                        <tr data-entry-id="{{ $player->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $player->id ?? '' }}
                            </td>
                            <td>
                                {{ $player->team->name ?? '' }}
                            </td>
                            <td>
                                @if($player->picture)
                                    <a href="{{ $player->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $player->picture->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $player->name ?? '' }}
                            </td>
                            <td>
                                {{ $player->prenom ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Player::TRANCHE_SELECT[$player->tranche] ?? '' }}
                            </td>
                            <td>
                                {{ $player->cine ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Player::SEXE_SELECT[$player->sexe] ?? '' }}
                            </td>
                            <td>
                                {{ $player->birthday_date ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Player::STATUS_SELECT[$player->status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Player::CATEGORY_SELECT[$player->category] ?? '' }}
                            </td>
                            <td>
                                @can('player_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.players.show', $player->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('player_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.players.edit', $player->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('player_delete')
                                    <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('player_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.players.massDestroy') }}",
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
  let table = $('.datatable-Player:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection