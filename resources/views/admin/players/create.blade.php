@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.player.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.players.store") }}" enctype="multipart/form-data">
            @csrf

           

              @if(auth()->user()->roles->contains(1))
              <div class="form-group">
                <label class="required" for="team_id">{{ trans('cruds.player.fields.team') }}</label>
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
                <span class="help-block">{{ trans('cruds.player.fields.team_helper') }}</span>
            </div>
                  
              @else
                  <input type="hidden" name="team_id" value="{{auth()->user()->team_id}}">
              @endif
              

            <div class="form-group">
                <label class="required" for="picture">{{ trans('cruds.player.fields.picture') }}</label>
                <div class="needsclick dropzone {{ $errors->has('picture') ? 'is-invalid' : '' }}" id="picture-dropzone">
                </div>
                @if($errors->has('picture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('picture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.picture_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.player.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prenom">{{ trans('cruds.player.fields.prenom') }}</label>
                <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" type="text" name="prenom" id="prenom" value="{{ old('prenom', '') }}" required>
                @if($errors->has('prenom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prenom') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.prenom_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.player.fields.tranche') }}</label>
                <select class="form-control {{ $errors->has('tranche') ? 'is-invalid' : '' }}" name="tranche" id="tranche" required>
                    <option value disabled {{ old('tranche', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Player::TRANCHE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tranche', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tranche'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tranche') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.tranche_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cine">{{ trans('cruds.player.fields.cine') }}</label>
                <input class="form-control {{ $errors->has('cine') ? 'is-invalid' : '' }}" type="text" name="cine" id="cine" value="{{ old('cine', '') }}">
                @if($errors->has('cine'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cine') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.cine_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.player.fields.sexe') }}</label>
                <select class="form-control {{ $errors->has('sexe') ? 'is-invalid' : '' }}" name="sexe" id="sexe" required>
                    <option value disabled {{ old('sexe', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Player::SEXE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('sexe', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('sexe'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sexe') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.sexe_helper') }}</span>
            </div>
            <input type="hidden" name="status" value="soumit au centre de traitement pour la validation">
            <div class="form-group">
                <label class="required" for="birthday_date">{{ trans('cruds.player.fields.birthday_date') }}</label>
                <input class="form-control date {{ $errors->has('birthday_date') ? 'is-invalid' : '' }}" type="text" name="birthday_date" id="birthday_date" value="{{ old('birthday_date') }}" required>
                @if($errors->has('birthday_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birthday_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.birthday_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.player.fields.category') }}</label>
                <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category" required>
                    <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Player::CATEGORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.category_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.pictureDropzone = {
    url: '{{ route('admin.players.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="picture"]').remove()
      $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($player) && $player->picture)
      var file = {!! json_encode($player->picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection