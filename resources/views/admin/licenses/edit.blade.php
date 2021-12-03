@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.license.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.licenses.update", [$license->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.license.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $license->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.license.fields.name_helper') }}</span>
            </div>

            
            <div class="form-group">
                <label class="required" for="details">{{ trans('cruds.license.fields.details') }}</label>
                <textarea class="form-control" id="editor1" name="details">{!! $license->details !!}</textarea>
                @if($errors->has('details'))
                <div class="invalid-feedback">
                    {{ $errors->first('details') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.license.fields.details_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.license.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $license->slug) }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.license.fields.slug_helper') }}</span>
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



        ClassicEditor
        .create( document.querySelector( '#editor1' ))
        .catch( error => {
            console.error( error );
            
        } );
        

        $('#name').change(function(e) {
        $.get('{{ route('admin.licenses.checkSlug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});
        

</script>
@endsection
