@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.book.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.books.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.book.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                    id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.book.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="book">{{ trans('cruds.book.fields.book') }}</label>
                <div class=" mb-2"> <div class="form-control {{ $errors->has('book') ? 'is-invalid' : '' }} custom-file" style="border:0"> <input type="file" name="book" class="custom-file-input" accept="book/*"> <label class="custom-file-label text-truncate" for="id_book">---</label> <script type="text/javascript" id="script-id_book">
                    document.getElementById("script-id_book").parentNode.querySelector('.custom-file-input').onchange =  function (e){
                        var filenames = "";
                        for (let i=0;i<e.target.files.length;i++){
                            filenames+=(i>0?", ":"")+e.target.files[i].name;
                        }
                        e.target.parentNode.querySelector('.custom-file-label').textContent=filenames;
                    }
                </script> </div> </div>
            </div>
            @if($errors->has('book'))
            <div class="invalid-feedback">
                {{ $errors->first('book') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.book.fields.book_helper') }}</span>
    <div class="form-group">
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
    </form>
</div>
</div>

@endsection
