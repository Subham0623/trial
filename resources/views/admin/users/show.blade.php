@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            Institute
                        </th>
                        <td>
                            {!! $user->user_detail->institute !!}
                        </td>
                    </tr>                    
                    <tr>
                        <th>
                            Institute Principal
                        </th>
                        <td>
                            {!! $user->user_detail->institute_principal !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Institute Contact 
                        </th>
                        <td>
                            {!! $user->user_detail->institute_contact !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Institute Province
                        </th>
                        <td>
                            {!! $user->user_detail->institute_province !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Institute District
                        </th>
                        <td>
                            {!! $user->user_detail->institute_district !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Institute Municipality
                        </th>
                        <td>
                            {!! $user->user_detail->institute_muncipality !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Institute Ward
                        </th>
                        <td>
                            {!! $user->user_detail->institute_ward !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Institute Street Name
                        </th>
                        <td>
                            {!! $user->user_detail->institute_street_name !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ID Card
                        </th>
                        <td>
                            <a href="{{ asset('storage/cards/'.$user->id.'/'.$user->user_detail->card)}}" target="_blank">
                                <img src="{{ asset('storage/cards/'.$user->id.'/'.$user->user_detail->card)}}" alt="">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection