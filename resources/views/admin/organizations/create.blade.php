@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.organization.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.organizations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.organization.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.name_helper') }}</span>
            </div>

            <div class="form-group" id=div_type>
                <label class="required" for="type">{{ trans('cruds.organization.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" >
                    <option value="">Select type</option>
                    @foreach($types as $type)
                    
                        <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>

                    @endforeach
                </select>
                @if($errors->has('type'))
                <div class="invalid-feedback">
                    {{ $errors->first('type') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.type_helper') }}</span>
            </div>
            <div id="organization-div" ></div>

            

            <div class="form-group">
                <label class="required" for="province">{{ trans('cruds.organization.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province" id="province" >
                    <option value="">Select Province</option>
                    @foreach($provinces as $province)
                    
                        <option value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>

                    @endforeach
                </select>
                @if($errors->has('province'))
                    <div class="invalid-feedback">
                        {{ $errors->first('province') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.province_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="district">{{ trans('cruds.organization.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district" id="district" >
                    <option value="">Select District</option>
                    @foreach($districts as $district)
                    
                        <option value="{{ $district->id }}" {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>

                    @endforeach
                </select>
                @if($errors->has('district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.district_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.organization.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.address_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="contact">{{ trans('cruds.organization.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', '') }}" required>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.contact_helper') }}</span>
            </div>

            <div class="form-group" style="display: none;">
                <label class="required" for="slug">{{ trans('cruds.organization.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.slug_helper') }}</span>
            </div>

            
            
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
                <a class="btn btn-default btn-close" href="{{ route("admin.organizations.index") }}">Cancel</a>

            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
$('#name').change(function(e) {
    $.get('{{ route('admin.organizations.checkSlug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});
</script>

<script>
     $('#type').change(function() {
    
    var type = $("#type").val();
    console.log(type);
    if(type .length > 0)
    {
        $.ajax({
               type:'GET',
               url:'/admins/type/organizations',
               data:{
                
                   type: type,
               },
               success:function(data) {
                   $('#organization-div').html(
                `<div class="form-group">
                <label class="required" for="organization">{{ trans('cruds.organization.fields.organization') }}</label>
                <select class="form-control select2 {{ $errors->has('organization') ? 'is-invalid' : '' }}" name="organization" id="organization" >
                    <option value="">Select Organization</option>
                    
                </select>
                @if($errors->has('province'))
                    <div class="invalid-feedback">
                        {{ $errors->first('province') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.province_helper') }}</span>
            </div>`);
            $.each(data, function (index, value) {
                            $("#organization").append("<option value=" + index + ">" +
                                value + "</option>");
                        });
                }
                });
    }
    
  });
</script>

<script>
     $('#province').change(function() {
    
    var province = $("#province").val();
    console.log(province);

    })
    if(!province) province = 0;
    if(province)
    
    {
        $.ajax({
               type:'GET',
               url:'/admins/organizations/organization-province',
               data:{
                
                   province: province,
               },
               cache: true,

               success:function(data) {
                console.log(data, 'sss')
                $("#district").empty();
                $("#district").append("<option value=''>Select District</option>");
                $.each(data, function (index, value) {
                            $("#district").append("<option value=" + index + ">" +
                                value + "</option>");
                        });
                    
                },
                error: function(err){
                    $("#district").empty();
                } 
                });
    }
    
  });
</script>

<!-- <script>
    $('#province').change(function() {
    
    var province = $("#province").val();
    console.log(province);  
    // Empty the dropdown
         $('#district').find('option').not(':first').remove();

         $.ajax({
           url: 'getEmployees/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var id = response['data'][i].id;
                 var name = response['data'][i].name;

                 var option = "<option value='"+id+"'>"+name+"</option>"; 

                 $("#sel_emp").append(option); 
               }
             }

           }
        });
      });
    }
</script> -->
@endsection