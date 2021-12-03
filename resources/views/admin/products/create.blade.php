@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="framework">{{ trans('cruds.product.fields.framework') }}</label>
                <input class="form-control {{ $errors->has('framework') ? 'is-invalid' : '' }}" type="text" name="framework" id="name" value="{{ old('framework', '') }}" required>
                @if($errors->has('framework'))
                    <div class="invalid-feedback">
                        {{ $errors->first('framework') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.framework_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
            </div>

            
            <div class="form-group">
                <label class="required" for="published_date">{{ trans('cruds.product.fields.published_date') }}</label>
                <input class="form-control {{ $errors->has('published_date') ? 'is-invalid' : '' }}" type="text" name="published_date" id="published_date" value="{{ old('published_date', '') }}" required>
                @if($errors->has('published_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('published_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.published_date_helper') }}</span>
            </div>
           
            <div class="form-group">
                <label class="" for="featured">{{ trans('cruds.product.fields.featured') }}</label><br>
                <input type="radio" name="featured" value="1" > Yes<br>
                <input type="radio" name="featured" value="0" checked> No<br>
                @if($errors->has('featured'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.featured_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple >
                    
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @foreach($category->childCategories as $childCategory)
                            <option value="{{ $childCategory->id }}" {{ old('category_id') == $childCategory->id ? 'selected' : '' }}>-- {{ $childCategory->name }}</option>                            
                            @foreach($childCategory->childCategories as $childCategory)
                                <option value="{{ $childCategory->id }}" {{ old('category_id') == $childCategory->id ? 'selected' : '' }}>---- {{ $childCategory->name }}</option>
                                @foreach($childCategory->childCategories as $childCategory)
                                    <option value="{{ $childCategory->id }}" {{ old('category_id') == $childCategory->id ? 'selected' : '' }}>---- {{ $childCategory->name }}</option>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            
            

            <div class="form-group">
                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                  <option value="">Select Level First</option>
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>

            

            <div class="form-group">
                <label for="authors">{{ trans('cruds.product.fields.author') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authors') ? 'is-invalid' : '' }}" name="authors[]" id="authors" multiple>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ in_array($id, old('authors', [])) ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('authors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('authors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.author_helper') }}</span>
            </div>
            
            

            <!-- <div class="form-group">
                <label for="licenses">{{ trans('cruds.product.fields.license') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('licenses') ? 'is-invalid' : '' }}" name="licenses[]" id="licenses" >
                    @foreach($licenses as $id => $license)
                        <option value="{{ $id }}" {{ in_array($id, old('licenses', [])) ? 'selected' : '' }}>{{ $license }}</option>
                    @endforeach
                </select>
                @if($errors->has('licenses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('licenses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.license_helper') }}</span>
            </div> -->

            <!-- <div class="form-group">
                <label class="required" for="license_id">{{ trans('cruds.product.fields.license') }}</label>
               
                <select class="form-control select2 {{ $errors->has('license_id') ? 'is-invalid' : '' }}" name="license_id" id="license_id" required>
                    <option value="">Select license</option>
                    @foreach($licenses as $id => $license)
                        <option value="{{ $id }}" {{ old('license_id') ? 'selected' : '' }}>{{ $license }}</option>
                    @endforeach
                </select>
                @if($errors->has('license_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('license_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.license_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
            </div> -->

            <!-- <div class="form-group">
                <label for="manual">{{ trans('cruds.product.fields.manual') }}</label>
                <div class=" mb-2"> 
                    <div class="form-control {{ $errors->has('manual') ? 'is-invalid' : '' }} custom-file" style="border:0"> 
                    <input type="file" name="manual" class="custom-file-input" accept=".pdf"> 
                    <label class="custom-file-label text-truncate" for="id_manual">---</label> 
                    <script type="text/javascript" id="script-id_manual">
                    document.getElementById("script-id_manual").parentNode.querySelector('.custom-file-input').onchange =  function (e){
                        var filenames = "";
                        for (let i=0;i<e.target.files.length;i++){
                            filenames+=(i>0?", ":"")+e.target.files[i].name;
                        }
                        e.target.parentNode.querySelector('.custom-file-label').textContent=filenames;
                    }
                    </script> 
                    </div> 
                </div>
                @if($errors->has('manual_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manual_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.manual_helper') }}</span>
            </div> -->

            <!-- <div class="row">
                <div class="col-md-12 form-group">
                    <label for="resource">Other Resources</label>
                    <div class="needsclick dropzone {{ $errors->has('resource') ? 'is-invalid' : '' }}"
                        id="resource-dropzone">
                    </div>
                    @if($errors->has('resource'))
                    <span class="text-danger">{{ $errors->first('resource') }}</span>
                    @endif
                </div>
            </div> -->

            <div class="form-group">
                <label class="required" for="licenses">{{ trans('cruds.product.fields.license') }}</label><br>
                
                @include('admin.products.partial')
                <!-- <table>
                @foreach($licenses as $license)
                    <tr>
                        <td><input data-id="{{ $license->id }}" type="checkbox" class="license-enable"></td>
                        <td>{{ $license->name }}</td>
                        <td><input value="{{ $license->value ?? null }}" data-id="{{ $license->id }}" name="licenses[{{ $license->id }}]" type="text" class="license-amount form-control" placeholder="Price" disabled></td>
                    </tr>
                @endforeach
                </table> -->
                @if($errors->has('licenses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('licenses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.license_helper') }}</span>
            </div>

            

            <div class="form-group">
                <label class="required" for="compatible_browsers">{{ trans('cruds.product.fields.compatible_browsers') }}</label>
                <input class="form-control {{ $errors->has('compatible_browsers') ? 'is-invalid' : '' }}" type="text" name="compatible_browsers" id="compatible_browsers" value="{{ old('compatible_browsers', '') }}" required>
                @if($errors->has('compatible_browsers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('compatible_browsers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.compatible_browsers_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="software_version">{{ trans('cruds.product.fields.software_version') }}</label>
                <input class="form-control {{ $errors->has('software_version') ? 'is-invalid' : '' }}" type="text" name="software_version" id="software_version" value="{{ old('software_version', '') }}" required>
                @if($errors->has('software_version'))
                    <div class="invalid-feedback">
                        {{ $errors->first('software_version') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.software_version_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.slug_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="overview">{{ trans('cruds.product.fields.overview') }}</label>
                <textarea class="form-control" id="editor1" name="overview"></textarea>
                @if($errors->has('overview'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overview') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.overview_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="features">{{ trans('cruds.product.fields.features') }}</label>
                <textarea class="form-control" id="editor2" name="features"></textarea>
                @if($errors->has('features'))
                    <div class="invalid-feedback">
                        {{ $errors->first('features') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.features_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="requirements">{{ trans('cruds.product.fields.requirements') }}</label>
                <textarea class="form-control" id="editor3" name="requirements"></textarea>
                @if($errors->has('requirements'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requirements') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.requirements_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="instructions">{{ trans('cruds.product.fields.instructions') }}</label>
                <textarea class="form-control" id="editor4" name="instructions"></textarea>
                @if($errors->has('instructions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instructions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.instructions_helper') }}</span>
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


    $('document').ready(function () {
            $('.license-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.license-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.license-amount[data-id="' + id + '"]').val(null)
            })
        });

        

class MyUploadAdapter {
    // ...
    constructor( loader ) {
        // The file loader instance to use during the upload. It sounds scary but do not
        // worry — the loader will be passed into the adapter later on in this guide.
        this.loader = loader;
    }
    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'POST', '{{route('admin.products.storeCKEditorImages')}}', true );
        xhr.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
        xhr.responseType = 'json';
    }


     // Initializes XMLHttpRequest listeners.
     _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve( {
                default: response.url
            } );
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest( file ) {
        // Prepare the form data.
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send( data );
    }
    // ...
}

function SimpleUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}

        ClassicEditor
        .create( document.querySelector( '#editor1' ), {
        extraPlugins: [ SimpleUploadAdapterPlugin ],}
         )
        .catch( error => {
            console.error( error );
            
        } );

        
        ClassicEditor
        .create( document.querySelector( '#editor2' ),{
        extraPlugins: [ SimpleUploadAdapterPlugin ],} 
        )
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
        .create( document.querySelector( '#editor3' ),{
        extraPlugins: [ SimpleUploadAdapterPlugin ],}
         )
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
        .create( document.querySelector( '#editor4' ) ,{
        extraPlugins: [ SimpleUploadAdapterPlugin ],}
        )
        .catch( error => {
            console.error( error );
        } );

        Dropzone.options.photoDropzone = {
        url: '{{ route('admin.products.storeMedia') }}',
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
    @if(isset($product) && $product->photo)
        var file = {!! json_encode($product->photo) !!}
            this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, '{{ $product->photo->getUrl('thumb') }}')
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

    var uploadedResourceMap = {}
        Dropzone.options.resourceDropzone = {
        url: '{{ route('admin.products.storeMedia') }}',
        maxFilesize: 164, // MB
        acceptedFiles: '.pdf',
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 2
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="resource[]" value="' + response.name + '">');
          uploadedResourceMap[file.name] = response.name;
          console.log(file);
          let extension = file.name.split('.').slice(-1)[0];
              if(! file.type.includes('image')){
              this.emit("thumbnail", file, "/img/extension/"+extension+".png");
              }
        },
        removedfile: function (file) {
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedResourceMap[file.name]
          }
          $('form').find('input[name="resource[]"][value="' + name + '"]').remove()
        },
        init: function () {
        @if(isset($product) && $product->resource)
          var files =
            {!! json_encode($product->resource) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              this.options.resource.call(this, file, file.url)
              let extension = file.file_name.split('.').slice(-1)[0];
              if(! file.mime_type.includes('image')){
              this.emit("thumbnail", file, "/img/extension/"+extension+".png");
              }
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="resource[]" value="' + file.file_name + '">')
            }
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
    $.get('{{ route('admin.products.checkSlug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});

$('#level_id').change(function(e) {
    $.get('{{ route('admin.levels.getSpecificTags') }}',
        { 'level_id': $(this).val() },
        function( data ) {
            console.log(data)
            $('#tags').empty();
            $tags = '<option value="">Please select tags</option>';
            for (var i in data) {
                console.log(data[i])
                $tags+='<option value="'+i+'" >'+data[i]+'</option>';
            }
            $('#tags').append($tags);
        }
    );
});




</script>


@endsection
