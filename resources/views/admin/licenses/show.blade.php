@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.license.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.licenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.license.fields.id') }}
                        </th>
                        <td>
                            {{ $license->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.license.fields.name') }}
                        </th>
                        <td>
                            {{ $license->name }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.license.fields.slug') }}
                        </th>
                        <td>
                            {{ $license->slug }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.license.fields.details') }}
                        </th>
                        <td>
                            {!! $license->details !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.licenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection