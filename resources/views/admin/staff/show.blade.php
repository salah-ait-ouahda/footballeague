@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.staff.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.staff.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.id') }}
                        </th>
                        <td>
                            {{ $staff->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.name') }}
                        </th>
                        <td>
                            {{ $staff->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.email') }}
                        </th>
                        <td>
                            {{ $staff->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $staff->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.team') }}
                        </th>
                        <td>
                            {{ $staff->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.photo') }}
                        </th>
                        <td>
                            @if($staff->photo)
                                <a href="{{ $staff->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $staff->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.staff.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection