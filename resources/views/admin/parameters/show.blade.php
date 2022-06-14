@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.parameter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parameters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.title') }}
                        </th>
                        <td>
                            {{ $parameter->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.status') }}
                        </th>
                        <td>
                            @if($parameter->status == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.description') }}
                        </th>
                        <td>
                            {{ $parameter->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.subject_area') }}
                        </th>
                        <td>
                            {{ $parameter->subjectArea ? $parameter->subjectArea->title : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.sort') }}
                        </th>
                        <td>
                            {{ $parameter->sort ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.option') }}
                        </th>
                        <td>
                            @foreach($parameter->options as $option)
                            Title: {{ $option->title }} 
                        <br>
                            Status: {{ $option->status == 1 ? 'Active' : 'Inactive'  }}
                        <br>
                            Points: {{ $option->points }}<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parameter.fields.document') }}
                        </th>
                        <td>
                            
                            @foreach($parameter->documents as $document)
                            Title: {{ $document->title }}
                        <br>
                            Status: {{ $document->status == 1 ? 'Active' : 'Inactive' }}
                            
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parameters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection