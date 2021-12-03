@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.popup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.popups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.id') }}
                        </th>
                        <td>
                            {{ $popup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.name') }}
                        </th>
                        <td>
                            {{ $popup->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.status') }}
                        </th>
                        <td>
                            @if($popup->status == 0)
                                Active
                            @else
                                Deactive
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.popup.fields.photo') }}
                        </th>
                        <td>
                            @if($popup->photo)
                                <a href="{{ $popup->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $popup->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.popups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection