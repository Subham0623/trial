@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.parameter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.parameters.update", [$parameter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.parameter.fields.title') }}</label>
                <!-- <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $parameter->title) }}" required> -->
                <textarea name="title" placeholder="Enter title" class="input form-control">{{ $parameter->title }}</textarea>
                
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.title_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.parameter.fields.description') }}</label>
                <!-- <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $parameter->description) }}" required> -->
                <textarea name="description" placeholder="Enter description" class="input form-control">{{ $parameter->description }}</textarea>
                
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="subject_area_id">{{ trans('cruds.parameter.fields.subject_area') }}</label>
                <select class="form-control select2 {{ $errors->has('subject_area_id') ? 'is-invalid' : '' }}" name="subject_area_id" id="subject_area_id" >
                    <option value="">Select Subject Area</option>
                    @foreach($subject_areas as $id => $area)
                    
                        <option value="{{ $area->id }}" {{ $parameter->subject_area_id == $area->id ? 'selected' : '' }}>{{ $area->title }}</option>

                    @endforeach
                </select>
                @if($errors->has('subject_area_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject_area_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.subject_area_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="sort">{{ trans('cruds.parameter.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="text" name="sort" id="sort" value="{{ old('sort', $parameter->sort) }}" required>
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.sort_helper') }}</span>
            </div>

            <label class="required" for="option">{{ trans('cruds.parameter.fields.option') }}</label>
            <table class="table table-bordered" id="dynamicTable">  
            <tr>
                <th>Title</th>
                <th>Points</th>
                <th>Action</th>
            </tr>
            
           
                @foreach($parameter->options as $key => $option)
                <tr class = "old_options">  
                    <!-- <td><input type="text" name="addmore[{{$key}}][title]"  class="form-control" value="{{$option->title}}" /></td>   -->
                    
                    <td><textarea name="addmore[{{$key}}][title]" class="input form-control">{{ $option->title }}</textarea></td> 
                    <td><input type="text" name="addmore[{{$key}}][points]"  class="form-control" value="{{$option->points}}" /></td> 
                    <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>  
                </tr>  
                @endforeach
                
            </table>
            <button type="button" name="add" id="add" class="btn btn-success mb-3">Add More</button><br>

            <label class="required" for="document">{{ trans('cruds.parameter.fields.document') }}</label>
            <table class="table table-bordered" id="dynamicTable1">  
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
            
           
                @foreach($parameter->documents as $key => $document)
                <tr class = "old_options1">  
                    <!-- <td><input type="text" name="addmore[{{$key}}][title]"  class="form-control" value="{{$option->title}}" /></td>   -->
                    
                    <td><textarea name="addmore1[{{$key}}][title]" class="input form-control">{{ $document->title }}</textarea></td> 
                    <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>  
                </tr>  
                @endforeach
                
        </table>
        <button type="button" name="add" id="add1" class="btn btn-success mb-3">Add More</button>


            <div class="form-group" style="display: none;">
                <label class="required" for="slug">{{ trans('cruds.parameter.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $parameter->slug) }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parameter.fields.slug_helper') }}</span>
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
    $.get('{{ route('admin.parameters.checkSlug') }}',
        { 'title': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});
</script>

<script type="text/javascript">
   
    var i = $('.old_options').length;
    console.log(i);
       
    $("#add").click(function(){
        ++i;

        $("#dynamicTable").append(`<tr>
        <td>
        <textarea name="addmore[${i}][title]" placeholder="Enter title" class="input form-control"></textarea>
        </td>
        <td>
        <input type="text" name="addmore[${i}][points]" placeholder="Enter points" class="form-control" />
        </td>
        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
        </tr>`);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  

</script>

<script type="text/javascript">
   
    var i = $('.old_options1').length;
    console.log(i);
       
    $("#add1").click(function(){
        ++i;

        $("#dynamicTable1").append(`<tr>
        <td>
        <textarea name="addmore1[${i}][title]" placeholder="Enter title" class="input form-control"></textarea>
        </td>
        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
        </tr>`);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  

</script>
@endsection