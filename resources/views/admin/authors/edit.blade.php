@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.author.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.authors.update", [$author->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.author.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $author->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.author.fields.gender') }}</label><br>
                <input type=radio name="gender" value="male" {{ $author->gender == 'male' ? 'checked' : ''}}> Male<br>
                 <input type=radio name="gender" value="female" {{ $author->gender == 'female' ? 'checked' : ''}}> Female<br>
                 <input type=radio name="gender" value="other" {{ $author->gender == 'other' ? 'checked' : ''}}> Other            
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.gender_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="short_bio">{{ trans('cruds.author.fields.short_bio') }}</label>
                <textarea class="form-control {{ $errors->has('short_bio') ? 'is-invalid' : '' }}" name="short_bio" id="short_bio">{{ old('short_bio', $author->short_bio) }}</textarea>
                @if($errors->has('short_bio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_bio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.short_bio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.author.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.author.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $author->slug) }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.slug_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.authors.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($author) && $author->photo)
      var file = {!! json_encode($author->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $author->photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

$('#name').change(function(e) {
    $.get('{{ route('admin.authors.checkSlug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});
</script>
@endsection
