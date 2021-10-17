<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBordereauRequest;
use App\Http\Requests\StoreBordereauRequest;
use App\Http\Requests\UpdateBordereauRequest;
use App\Models\Bordereau;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BordereauController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bordereau_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bordereaus = Bordereau::with(['team'])->get();

        return view('frontend.bordereaus.index', compact('bordereaus'));
    }

    public function create()
    {
        abort_if(Gate::denies('bordereau_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bordereaus.create', compact('teams'));
    }

    public function store(StoreBordereauRequest $request)
    {
        $bordereau = Bordereau::create($request->all());

        return redirect()->route('frontend.bordereaus.index');
    }

    public function edit(Bordereau $bordereau)
    {
        abort_if(Gate::denies('bordereau_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bordereau->load('team');

        return view('frontend.bordereaus.edit', compact('teams', 'bordereau'));
    }

    public function update(UpdateBordereauRequest $request, Bordereau $bordereau)
    {
        $bordereau->update($request->all());

        return redirect()->route('frontend.bordereaus.index');
    }

    public function show(Bordereau $bordereau)
    {
        abort_if(Gate::denies('bordereau_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bordereau->load('team');

        return view('frontend.bordereaus.show', compact('bordereau'));
    }

    public function destroy(Bordereau $bordereau)
    {
        abort_if(Gate::denies('bordereau_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bordereau->delete();

        return back();
    }

    public function massDestroy(MassDestroyBordereauRequest $request)
    {
        Bordereau::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
