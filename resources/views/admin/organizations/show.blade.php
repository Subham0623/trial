@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.organization.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.id') }}
                        </th>
                        <td>
                            {{ $organization->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.name') }}
                        </th>
                        <td>
                            {{ $organization->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.province') }}
                        </th>
                        <td>
                            {{ $organization->province->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.district') }}
                        </th>
                        <td>
                            {{ $organization->district->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.address') }}
                        </th>
                        <td>
                            {{ $organization->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.contact') }}
                        </th>
                        <td>
                            {{ $organization->contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.slug') }}
                        </th>
                        <td>
                            {{ $organization->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection