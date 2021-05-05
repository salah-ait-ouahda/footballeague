@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.player.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.players.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.id') }}
                        </th>
                        <td>
                            {{ $player->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.team') }}
                        </th>
                        <td>
                            {{ $player->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.picture') }}
                        </th>
                        <td>
                            @if($player->picture)
                                <a href="{{ $player->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $player->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.name') }}
                        </th>
                        <td>
                            {{ $player->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.prenom') }}
                        </th>
                        <td>
                            {{ $player->prenom }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.tranche') }}
                        </th>
                        <td>
                            {{ App\Models\Player::TRANCHE_SELECT[$player->tranche] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.cine') }}
                        </th>
                        <td>
                            {{ $player->cine }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.sexe') }}
                        </th>
                        <td>
                            {{ App\Models\Player::SEXE_SELECT[$player->sexe] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.birthday_date') }}
                        </th>
                        <td>
                            {{ $player->birthday_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Player::STATUS_SELECT[$player->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\Player::CATEGORY_SELECT[$player->category] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.players.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection