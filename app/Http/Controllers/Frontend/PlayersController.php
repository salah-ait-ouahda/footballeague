<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPlayerRequest;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PlayersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('player_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $players = Player::with(['team', 'media'])->get();

        $teams = Team::get();

        return view('frontend.players.index', compact('players', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('player_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.players.create', compact('teams'));
    }

    public function store(StorePlayerRequest $request)
    {
        $player = Player::create($request->all());

        if ($request->input('picture', false)) {
            $player->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $player->id]);
        }

        return redirect()->route('frontend.players.index');
    }

    public function edit(Player $player)
    {
        abort_if(Gate::denies('player_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $player->load('team');

        return view('frontend.players.edit', compact('teams', 'player'));
    }

    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $player->update($request->all());

        if ($request->input('picture', false)) {
            if (!$player->picture || $request->input('picture') !== $player->picture->file_name) {
                if ($player->picture) {
                    $player->picture->delete();
                }
                $player->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
            }
        } elseif ($player->picture) {
            $player->picture->delete();
        }

        return redirect()->route('frontend.players.index');
    }

    public function show(Player $player)
    {
        abort_if(Gate::denies('player_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $player->load('team');

        return view('frontend.players.show', compact('player'));
    }

    public function destroy(Player $player)
    {
        abort_if(Gate::denies('player_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $player->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlayerRequest $request)
    {
        Player::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('player_create') && Gate::denies('player_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Player();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
