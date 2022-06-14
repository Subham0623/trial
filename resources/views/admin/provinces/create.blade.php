@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.province.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.provinces.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.province.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.province.fields.name_helper') }}</span>
            </div>


            
            <!-- <div class="form-group">
                <label class="required" for="sort">{{ trans('cruds.province.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="text" name="sort" id="sort" value="{{ old('sort', '') }}" required>
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.province.fields.sort_helper') }}</span>
            </div> -->
            
            

            <label class="required" for="district">{{ trans('cruds.province.fields.district') }}</label>
            <table class="table table-bordered" id="dynamicTable">  
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <tr>  
                <td><input type="text" name="addmore[0][name]" placeholder="Enter name" class="form-control" value="{{ old('addmore')[0]['name'] ?? '' }}" required></td>  
                
            </tr>  
        </table>
        <button type="button" name="add" id="add" class="btn btn-success mb-3">Add More</button>

            

            


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default btn-close" href="{{ route("admin.provinces.index") }}">Cancel</a>

            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')


<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
        ++i;
        console.log(i);
   
        $("#dynamicTable").append(`<tr>
        <td>
        <input type="text" name="addmore[${i}][name]" placeholder="Enter name" class="form-control" required>
        </td>
        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
        </tr>`);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>
@endsection