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

                    <!-- You are logged in! -->

                    
                

                <div class="row boxes">

                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$organizations}}</h3>

                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{route('admin.organizations.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
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

                    <div class="col-lg-3 col-6">
                <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$auditors}}</h3>

                                <p>Total Auditors</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{route('admin.organizations.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$finalVerifiers}}</h3>

                                <p>Total Final Verifiers</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{route('admin.organizations.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row pt-5">
                    
                        <div class="col-2">
                            <select name="province" id="province_org">
                                <option value = "">Select province</option>
                                @foreach($provinces as $province)
                                    <option class = "provinces" value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class = "col-2">
                            <select name="district" id="district_org">
                            <option value = "">Select district</option>
                            @foreach($districts as $district)
                                <option class = "districts" value="{{ $district->id }}" {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <a  class= "btn btn-success" id="search">Search</a>
                        </div>

                    
                </div>


                <!-- <div id="container" style="width:100%; height:400px;" class="mt-5">
                    <select name="provinces" id="province">
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
                </div>-->
                <div id="container" style="width:100%; height:400px;" class="mt-5">
                    <!-- <select name="districts" id="district">
                        <option value = "">Select district</option>
                            @foreach($districts as $district)
                            <option class = "districts" value="{{ $district->id }}" {{ old('district') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                    </select> -->
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
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                            
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
<!-- <script>
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
</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="province"]').on('change', function() {
            var provinceID = $(this).val();
            if(provinceID) {
                $.ajax({
                    url: 'admins/province-select/'+provinceID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="district"]').empty();
                        $('select[name="district"]').append("<option value=''>Select District</option>");
                        $.each(data, function(key, value) {
                            $('select[name="district"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="district"]').empty();
            }
        });

        

    });
</script>
<script>
    $("#search").click(function(){
            var province = $('#province_org').val();
            console.log(province);
            var district = $('#district_org').val();
            console.log(district);

            if(district == '' && province == '')
            {
                alert('select any option first');
            }
            else{

                $.ajax({
                        url: 'admins/search-organizations',
                        type: "GET",
                        dataType: "json",
                        data:{
                            'province': province,
                            'district': district,
                        },
                        success:function(data) {
                            console.log(data);
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
                                        <td><button class="view">View Forms</button></td>
                                        </tr>`;
                                    });
                                    newData += '</tbody>';
                                    $("#list2 table ").append(newData);
                                                        }
                                                    });
            }


                    
                
        });
</script>
<script>
    $('.view').click(function(){
        alert('hello');
    });
</script>
@endsection

