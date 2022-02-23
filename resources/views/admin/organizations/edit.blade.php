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

            <div class="form-group">
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

            <div class="form-group">
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
            
            <div class="form-group">
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
     $('#province').change(function() {
    
    var province = $("#province").val();
    console.log(province);
    if(province .length > 0)
    {
        $.ajax({
               type:'GET',
               url:'/admins/organizations/organization-province',
               data:{
                
                   province: province,
               },
               success:function(data) {
                $("#district").empty();
                $("#district").append("<option value=''>Select District</option>");
                $.each(data, function (index, value) {
                            $("#district").append("<option value=" + index + ">" +
                                value + "</option>");
                        });
                    
                }
                });
    }
    
  });
</script>
@endsection