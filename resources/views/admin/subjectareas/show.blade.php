@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subjectarea.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subject-areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectarea.fields.id') }}
                        </th>
                        <td>
                            {{ $subject_area->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectarea.fields.title') }}
                        </th>
                        <td>
                            {{ $subject_area->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectarea.fields.sort') }}
                        </th>
                        <td>
                            {{ $subject_area->sort }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectarea.fields.slug') }}
                        </th>
                        <td>
                            {{ $subject_area->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subject-areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection