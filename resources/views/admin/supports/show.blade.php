@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.support.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.id') }}
                        </th>
                        <td>
                            {{ $support->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.product') }}
                        </th>
                        <td>
                            {{ $support->product->name }}
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.details') }}
                        </th>
                        <td>
                            {!! $support->details !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection