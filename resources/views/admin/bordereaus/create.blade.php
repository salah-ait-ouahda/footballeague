@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bordereau.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bordereaus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="team_id">{{ trans('cruds.bordereau.fields.team') }}</label>
                <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id" required>
                    @foreach($teams as $id => $entry)
                        <option value="{{ $id }}" {{ old('team_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('team'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bordereau.fields.team_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bordereau.fields.etat') }}</label>
                <select class="form-control {{ $errors->has('etat') ? 'is-invalid' : '' }}" name="etat" id="etat" required>
                    <option value disabled {{ old('etat', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Bordereau::ETAT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('etat', 'soumit au centre de traitement pour la validation') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('etat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('etat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bordereau.fields.etat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.bordereau.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note') }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bordereau.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection