@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.author.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.authors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.author.fields.id') }}
                        </th>
                        <td>
                            {{ $author->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.author.fields.name') }}
                        </th>
                        <td>
                            {{ $author->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.author.fields.gender') }}
                        </th>
                        <td>
                            {{ $author->gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.author.fields.short_bio') }}
                        </th>
                        <td>
                            {{ $author->short_bio }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.author.fields.photo') }}
                        </th>
                        <td>
                            @if($author->photo)
                                <a href="{{ $author->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $author->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.author.fields.slug') }}
                        </th>
                        <td>
                            {{ $author->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.authors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection