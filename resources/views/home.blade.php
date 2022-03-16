@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    
                </div>

                <div class="col-lg-3 col-6">
            <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$organizations}}</h3>

                            <p>Total Organizations</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-sitemap"></i>
                        </div>
                        <a href="{{route('admin.organizations.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div id="container" style="width:100%; height:400px;" class="mt-5">
                    <select name="province" id="province">
                        <option value = "">Select province</option>
                            @foreach($provinces as $province)
                            <option class = "provinces" value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                    </select>
                <div id = "list">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Organization">
                            <thead>
                                <tr>
                                    
                                    <th>
                                        {{ trans('cruds.organization.fields.sn') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.province') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.contact') }}
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                            
                        
                    </div>
                </div>
                <div id="container" style="width:100%; height:400px;" class="mt-5">
                    <select name="district" id="district">
                        <option value = "">Select district</option>
                            @foreach($districts as $district)
                            <option class = "districts" value="{{ $district->id }}" {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                    </select>
                <div id="list2">
                <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Organization">
                            <thead>
                                <tr>
                                    
                                    <th>
                                        {{ trans('cruds.organization.fields.sn') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.province') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.district') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organization.fields.contact') }}
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                            
                        
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection

@section('scripts')
<script>
        $(document).ready(function(){
                    $('#province').change(function(){
                        // e.preventDefault();
                        
                        console.log('here');    
                        
                        var province = $(this).val();
                        console.log(province);
                    
                        if(province.length > 0)
                        {
                            $.ajax({
                                url:"admins/province/organizations",
                                
                                type:'GET',
                                data: {
                                    province: province,
                                    },
                                    success: function(data){
                                    // window.location=res.url;
                                    console.log(data);
                                    // $("#list").empty();
                                    // var resulttag = "";
                                    // resulttag += "<tr><td>result</td></tr>";
                                    // $("#table tbody").append(resulttag);

                                    

                                //    var html = `
                                //    <tr>
                                //         <th>
                                //         hello
                                //         </th>
                                //     </tr>`;
                                //     $('#list table tbody').append(html2);
                                //     $('#list table tbody').append(html);
                                    
                                $("#list table tbody").empty();
                                    let newData = '<tbody>';
                                    $.each(data, function(key, value) {
                                        newData += `
                                        <tr>
                                        <td>${key+1}</td>
                                        <td>${value.name}</td>
                                        <td>${value.province_id}</td>
                                        <td>${value.district_id}</td>
                                        <td>${value.address}</td>
                                        <td>${value.contact}</td>
                                        </tr>`;
                                    });
                                    newData += '</tbody>';
                                    $("#list table ").append(newData);
                                                        }
                                                        
                                                        
                                                    });
                                            }
                                    
                        
                        

                        
                        
                    });
                    });
    </script>

<script>
    $(document).ready(function(){
                $('#district').change(function(){
                    // e.preventDefault();
                    
                    console.log('here');    
                    
                    var district = $(this).val();
                    console.log(district);
                
                    if(district.length > 0)
                    {
                        $.ajax({
                            url:"admins/district/organizations",
                            
                            type:'GET',
                            data: {
                                district: district,
                                },
                                success: function(data){
                                // window.location=res.url;
                                console.log(data);
                                // $("#list").empty();
                                // var resulttag = "";
                                // resulttag += "<tr><td>result</td></tr>";
                                // $("#table tbody").append(resulttag);

                                

                            //    var html = `
                            //    <tr>
                            //         <th>
                            //         hello
                            //         </th>
                            //     </tr>`;
                            //     $('#list table tbody').append(html2);
                            //     $('#list table tbody').append(html);
                                
                            $("#list2 table tbody").empty();
                                let newData = '<tbody>';
                                $.each(data, function(key, value) {
                                    newData += `
                                    <tr>
                                    <td>${key+1}</td>
                                    <td>${value.name}</td>
                                    <td>${value.province_id}</td>
                                    <td>${value.district_id}</td>
                                    <td>${value.address}</td>
                                    <td>${value.contact}</td>
                                    </tr>`;
                                });
                                newData += '</tbody>';
                                $("#list2 table ").append(newData);
                                                    }
                                                    
                                                    
                                                });
                                        }
                                
                    
                    

                    
                    
                });
                });
</script>
@endsection

