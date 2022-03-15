@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subjectarea.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subject-areas.update", [$subjectArea->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.subjectarea.fields.title') }}</label>
                <!-- <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $subjectArea->title) }}" required> -->
                <textarea name="title" placeholder="Enter title" class="input form-control" id="title">{{ $subjectArea->title }}</textarea>
                
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subjectarea.fields.title_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="sort">{{ trans('cruds.subjectarea.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="text" name="sort" id="sort" value="{{ old('sort', $subjectArea->sort) }}" required>
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subjectarea.fields.sort_helper') }}</span>
            </div>

            <div class="form-group" style="display: none;">
                <label class="required" for="slug">{{ trans('cruds.subjectarea.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $subjectArea->slug) }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subjectarea.fields.slug_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
$('#title').change(function(e) {
    $.get('{{ route('admin.subject-areas.checkSlug') }}',
        { 'title': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});
</script>

@endsection