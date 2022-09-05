@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.organization.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.organizations.update", [$organization->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.organization.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $organization->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.name_helper') }}</span>
            </div>

            <div class="form-group type-element">
                <label class="required" for="type">{{ trans('cruds.organization.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" >
                    <option value="">Select Type</option>
                    @foreach($types as  $type)
                    
                        <option value="{{ $type->id }}" {{ $organization->type_id == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>

                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.type_helper') }}</span>
            </div>

            <div class="form-group active-field organization-element">
                <label class="required" for="organization">{{ trans('cruds.organization.fields.organization') }}</label>
                <select class="form-control select2 {{ $errors->has('organization') ? 'is-invalid' : '' }}" name="organization" id="organization" >
                    <option value="">Select organization</option>
                    @foreach($organizations as  $org)
                    
                        <option value="{{ $org->id }}" {{ $organization->organization_id == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>

                    @endforeach
                </select>
                @if($errors->has('organization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.organization_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="governance">{{ trans('cruds.organization.fields.governance') }}</label>
                <select class="form-control select2 {{ $errors->has('governance') ? 'is-invalid' : '' }}" name="governance" id="governance" >
                    <option value="">Select governance</option>
                    @foreach($governances as $governance)
                    
                        <option value="{{ $governance->id }}" {{ $organization->governance_id == $governance->id ? 'selected' : '' }}>{{ $governance->title }}</option>

                    @endforeach
                </select>
                @if($errors->has('governance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('governance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.governance_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="levels">{{ trans('cruds.organization.fields.level') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('levels') ? 'is-invalid' : '' }}" name="levels[]" id="levels" multiple required>
                    @foreach($levels as $id => $levels)
                        <option value="{{ $id }}" {{ (in_array($id, old('levels', [])) || $organization->levels->contains($id)) ? 'selected' : '' }}>{{ $levels }}</option>
                    @endforeach
                </select>
                @if($errors->has('levels'))
                    <div class="invalid-feedback">
                        {{ $errors->first('levels') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.level_helper') }}</span>
            </div>

            <div class="form-group province-element" id="div-province">
                <label class="required" for="province">{{ trans('cruds.organization.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province" id="province" >
                    <option value="">Select Province</option>
                    @foreach($provinces as $province)
                    
                        <option value="{{ $province->id }}" {{ $organization->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>

                    @endforeach
                </select>
                @if($errors->has('province'))
                    <div class="invalid-feedback">
                        {{ $errors->first('province') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.province_helper') }}</span>
            </div>

            <div class="form-group district-select" id="div-district">
                <label class="required" for="district">{{ trans('cruds.organization.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district" id="district" >
                    <option value="">Select District</option>
                    @foreach($districts as  $district)
                    
                        <option value="{{ $district->id }}" {{ $organization->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>

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
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $organization->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.address_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="contact">{{ trans('cruds.organization.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', $organization->contact) }}" required>
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organization.fields.contact_helper') }}</span>
            </div>
            
            <div class="form-group" style="display: none;">
                <label class="required" for="slug">{{ trans('cruds.organization.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $organization->slug) }}" required>
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
    var level = $("#type").val();
    console.log(level);
    if(level == 1)
    {
        $('#div-province').hide();
        $('#province').prop('disabled', true);
        $('#div-district').hide();
        $('#district').prop('disabled',true);
    }
</script>
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
    var spinner = `<div class="block text-center custom__spinner">
    
    <div class="spinner-border" role="status" style="width: 1rem; height: 1rem">
                         <span class="sr-only">Loading...</span>
                    </div> Please Wait
    
    <div/>
                    
                    `
                    ;
        document.querySelector('.type-element').addEventListener('click', function(e){

        $('#select2-organization-container').html(spinner);

    })

  

    

     $('#type').change(function() {
    
    var type = $("#type").val();
    
    if(type == 1 || !type){
        $('#div-province').hide();
        $('#province').prop('disabled', true);
        $('#div-district').hide();
        $('#district').prop('disabled',true);

        document.querySelector('.active-field').style.display = 'none';
    }else{
        $('#div-province').show();
        $('#province').prop('disabled', false);
        $('#div-district').show();
        $('#district').prop('disabled',false);

        document.querySelector('.active-field').style.display = 'block';

    }

    
    if(type.length > 0)
    {
        $.ajax({
               type:'GET',
               url:'/admins/type/organizations',
               data:{
                
                   type: type,
               },
               success:function(data) {
                $("#organization").empty();
                $("#organization").append("<option value=''>Select Organization</option>");
                $.each(data, function (index, value) {
                            $("#organization").append("<option value=" + index + ">" +
                                value + "</option>");
                        });

                        if(document.querySelector('.custom__spinner')){

document.querySelector('.custom__spinner').style.display = 'none';
}
                }
                });
    }
    
  });
</script>
<script>
    let pending = true;
    var spinner = `<div class="block text-center custom__spinner">
    
    <div class="spinner-border" role="status" style="width: 1rem; height: 1rem">
                         <span class="sr-only">Loading...</span>
                    </div> Please Wait
    
    <div/>
                    
                    `
                    ;
        document.querySelector('.province-element').addEventListener('click', function(e){

        $('#select2-organization-container').html(spinner);

    })
     $('#province').change(function() {
    
    var province = $("#province").val();
    
    if(province.length >= 0)
    {
        $.ajax({
               type:'GET',
               url:'/admins/organizations/organization-province',
               data:{
                
                   province: province,
               },
               cache: true,
               success:function(data) {
                $("#district").empty();
                $("#district").append("<option value=''>Select District</option>");
                $.each(data, function (index, value) {
                            $("#district").append("<option value=" + index + ">" +
                                value + "</option>");
                        });
                        if(document.querySelector('.custom__spinner')){

                            document.querySelector('.custom__spinner').style.display = 'none';
                        }

                },
                error: function(err){
                    $("#district").empty();
                }
                
                });
    }

    // if(pending){
    //     console.log(document.querySelector('#select2-district-container'))

    //     document.querySelector('#select2-district-container').style.pointerEvents = 'none';
    //     document.querySelector('#select2-district-container').style.cursor = 'progress';
    // }else{
    //     document.querySelector('#select2-district-container').style.pointerEvents = 'auto';
    //     document.querySelector('#select2-district-container').style.cursor = 'pointer';

    // }
    
  });
</script>
@endsection