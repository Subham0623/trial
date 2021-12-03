@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.book.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.books.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.id') }}
                        </th>
                        <td>
                            {{ $book->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.title') }}
                        </th>
                        <td>
                            {{ $book->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.book.fields.book') }}
                        </th>
                        <td>
                            <a href="{{ $book->getFirstMedia('book')->getUrl() }}">{{ $book->getFirstMedia('book')->name }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.books.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
