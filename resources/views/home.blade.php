@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background: #f5f9fc !important">
                <div class="card-header" style="background: #ffff; border-bottom: 1px solid #e7eaf0; font-size: 27px">
                    Dashboard
                </div>

                <div class="card-body" style="display: none">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert" id="messageId">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- you are logged in -->
                </div>
                <div id="messageId" class="container-fluid"></div>
                <div class="row container-fluid section__seperator" style="padding: 0; margin: 0 auto">
                    <!-- <div class="col-sm-3">
                        <div class="home-title"><span class="">PLGSP|</span><span class=""
                                style="font-size: 18px; font-weight: bold; color: black; margin-left: 5px;">Home</span>
                        </div>
                    </div> -->
                    {{-- <div class="col-sm-3">
                        <div class="position-relative form-group"><select name="fiscal_year" id="fiscalYearSelect"
                                class="form-control filter">
                                <option value="" disabled>Select Fiscal Year</option>
                                @foreach($years as $key => $year)
                                <option value="{{$year}}" {{ $year == $fiscal_year ? 'selected' : '' }}>{{$year}}
                                </option>
                                @endforeach
                            </select></div>
                    </div>

                    <div class="col-sm-3">
                        <div class="position-relative form-group"><select placeholder="Select Province" name="province"
                                id="provinceId" class="form-control filter">
                                <option value="">Select Province</option>
                                @foreach($provinces as $item)
                                <option value="{{$item->id}}" {{ $item->id == $province ? 'selected' : '' }}>
                                    {{$item->name}}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="position-relative form-group"><select placeholder="Select District" name="district"
                                id="districtId" class="form-control filter">
                                <option value="">Select District</option>
                                @foreach($districts as $item)
                                <option value="{{$item->id}}" {{ $item->id == $district ? 'selected' : '' }}>
                                    {{$item->name}}</option>
                                @endforeach
                            </select></div>
                    </div> 
                    <div class="col-sm-3" >
                        <a class="btn btn-primary" id="search" style="color: #fff">Search</a>
                    </div>
                    <!-- <div class="col-sm-2">
                        <div class="position-relative form-group"><select placeholder="पालिका चयन गर्नुहोस"
                                name="palikaId" id="palikaId" class="form-control">
                                <option value="0" disabled="">पालिका चयन गर्नुहोस</option>
                            </select></div>
                    </div> -->

                </div>--}}
                <div class="row">
                <div class="col-sm-3">
                        <div class="position-relative form-group"><select name="fiscal_year" id="fiscalYearSelect"
                                class="form-control filter">
                                <option value="" disabled>Select Fiscal Year</option>
                                @foreach($years as $key => $year)
                                <option value="{{$year}}"{{ $year == $fiscal_year ? 'selected' : '' }} >{{$year}}
                                </option>
                                @endforeach
                            </select></div>
                    </div>
                <div class="col-sm-2">
                    <div class="position-relative form-group"><select placeholder="Select Ministry" name="ministry"
                            id="ministryId" class="form-control filter">
                            <option value="">Select Ministry</option>
                            @foreach($ministry as $item)
                            <option value="{{$item->id}}" {{ $item->id == $ministry_id ? 'selected' : '' }}>
                                {{$item->name}}</option>
                            @endforeach
                        </select></div>
                </div>
                <div class="col-sm-3">
                    <div class="position-relative form-group"><select placeholder="Select Department" name="department"
                            id="departmentId" class="form-control filter">
                            <option value="">Select Department</option>
                            @foreach($departments as $item)
                            <option value="{{$item->id}}" {{ $item->id == $department_id ? 'selected' : '' }}>
                                {{$item->name}}</option>
                            @endforeach
                        </select></div>
                </div>
                <div class="col-sm-2">
                    <div class="position-relative form-group"><select placeholder="Select District" name="districtOrg"
                            id="districtOrgId" class="form-control filter">
                            <option value="">Select District</option>
                            @foreach($districtOrgs as $item)
                            <option value="{{$item->id}}" {{ $item->id == $districtOrg_id ? 'selected' : '' }}>
                                {{$item->name}}</option>
                            @endforeach
                        </select></div>
                </div>
                {{-- <div class="col-sm-2">
                    <div class="position-relative form-group"><select placeholder="Select Area" name="area"
                            id="areaId" class="form-control filter">
                            <option value="">Select Area</option>
                            @foreach($ilakas as $item)
                            <option value="{{$item->id}}">
                                {{$item->name}}</option>
                            @endforeach
                        </select></div>
                </div> --}}
                <div class="col-sm-3" >
                        <a class="btn btn-primary" id="filter" style="color: #fff">Search</a>
                    </div>
                </div>

                <div class="row container-fluid first__custom-section" style="padding: 0; margin: 0 auto">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Organizations</h5>
                                <p class="card-text" style="font-size:20px;">{{$total_orgs}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Published Forms</h5>
                                <p class="card-text" style="font-size:20px;">{{$published_forms}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Organizations(Submitted forms))</h5>
                                <p class="card-text" style="font-size:20px;">{{$submittedFormOrgs}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Highest Score</h5>
                                <p class="card-text" style="font-size:20px;">{{$highest_score ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Lowest Score</h5>
                                <p class="card-text" style="font-size:20px;">{{$lowest_score ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Average Score</h5>
                                <p class="card-text" style="font-size:20px;">{{$average_score ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Organizations(Ministry)</h5>
                                <p class="card-text" style="font-size:20px;">{{$total_ministry ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Organizations(Department)</h5>
                                <p class="card-text" style="font-size:20px;">{{$department ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Organization(District)</h5>
                                <p class="card-text" style="font-size:20px;">{{$districtOrg ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Organizations(Ilaka)</h5>
                                <p class="card-text" style="font-size:20px;">{{$ilaka ?? 0}}</p>
                                <!-- <a href="#" class="btn btn-primary">View more</a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-layout container-fluid mt-5">
                    <div class="row custom__table-alignment">
                        <div class="card shadow border-0 text-center overflow-hidden custom__table-alignment-first"
                            style="padding:0">
                            <div class="row table-heading w-100" style="transform: translateX(15px);">
                                <div class="card-header" style="width: 100%; background: #fff">
                                    <h6 class="sub-heading">10 organizations with highest score</h6>
                                </div>
                            </div>
                            <div class="row table-responsive" style="transform: translateX(15px); height: 100%">
                                <table class="table table-hover table-nowrap"
                                    style="flex: 1; margin-bottom: 0; height:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="border:none">S.N</th>
                                            <th scope="col" style="border:none">Organizations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($topOrgs)>0)
                                        @foreach($topOrgs as $key => $top)
                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold"
                                                    href="{{route('admin.organization-detail',[$top->id])}}">{{$top->name}}
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <th colspan="2">No data found</th>
                                        </tr>

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card shadow border-0 text-center overflow-hidden" style="padding:0">
                            <div class="row table-heading w-100" style="transform: translateX(15px);">
                                <div class="card-header" style="width: 100%; background: #fff">
                                    <h6 class="sub-heading">10 organizations with lowest score</h6>
                                </div>
                            </div>
                            <div class="row table-responsive" style="transform: translateX(15px); height: 100%">
                                <table class="table table-hover table-nowrap"
                                    style="flex: 1; margin-bottom: 0; height:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="border:none">S.N</th>
                                            <th scope="col" style="border:none">Organizations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lowOrgs)>0)
                                        @foreach($lowOrgs as $key => $low)
                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold"
                                                    href="{{route('admin.organization-detail',[$low->id])}}">{{$low->name}}
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <th colspan="2">No data found</th>
                                        </tr>

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- <div class="col mb-3 col-6 text-center">
                            <div class="row table-heading">
                                <div class="col-md-6">
                                    <h6 class="sub-heading">10 organizations with lowest score</h6>
                                </div>
                            </div>
                            <div class="row container">
                                <table class="table table-responsive table-bordered my-custom__table">
                                    <thead>
                                        <tr>
                                            <th class="toplevel">S.N. </th>
                                            <th id="fam" style="width: 100%;" class="toplevel">Organizations</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lowOrgs)>0)
                                        @foreach($lowOrgs as $key => $low)

                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td><a
                                                    href="{{route('admin.organization-detail',[$low->id])}}">{{$low->name}}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <th colspan="2">No data found</th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                    </div>
                </div>
                <div class="card-layout container-fluid mt-3">
                    <div class="row custom__table-alignment">
                        <div class="card shadow border-0 text-center overflow-hidden custom__table-alignment-first"
                            style="padding:0">
                            <div class="row table-heading w-100" style="transform: translateX(15px);">
                                <div class="card-header" style="width: 100%; background: #fff">
                                    <h6 class="sub-heading">Total Marks of all the organizations based on subject areas
                                    </h6>
                                </div>
                            </div>
                            <div class="row table-responsive" style="transform: translateX(15px); height: 100%">
                                <table class="table table-hover table-nowrap"
                                    style="flex: 1; margin-bottom: 0; height:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="border:none">S.N</th>
                                            <th scope="col" style="border:none">Subject Areas</th>
                                            <th scope="col" style="border:none">Total Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subjectAreas as $key => $subjectArea)
                                        @php
                                        $total_marks = 0;
                                        $subjectAreaTotal = 0;
                                        $form_subject_area =
                                        App\FormSubjectArea::where('subject_area_id',$subjectArea->id)->whereIn('form_id',$forms)->get();

                                        foreach($form_subject_area as $item){
                                        $total_marks = $item->marksByFinalVerifier + $total_marks;
                                        }
                                        if($subjectArea->parameters)
                                        {

                                        foreach($subjectArea->activeParameters as $parameter)
                                        {
                                        $subjectAreaTotal = $parameter->activeOptions()->max('points') +
                                        $subjectAreaTotal;
                                        }
                                        }

                                        if($published_forms !== 0 && $subjectAreaTotal !== 0)
                                        {

                                        $percentage = ($total_marks/($subjectAreaTotal*$published_forms))*100;
                                        }
                                        else
                                        {
                                        $percentage = 0;
                                        }
                                        @endphp

                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>
                                                {{$subjectArea->title}}
                                            </td>
                                            <td>
                                                {{$percentage}}%
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        

                        <!-- <div class="col mb-3 col-6 text-center">
                            <div class="row table-heading">
                                <div class="col-md-6">
                                    <h6 class="sub-heading">10 organizations with lowest score</h6>
                                </div>
                            </div>
                            <div class="row container">
                                <table class="table table-responsive table-bordered my-custom__table">
                                    <thead>
                                        <tr>
                                            <th class="toplevel">S.N. </th>
                                            <th id="fam" style="width: 100%;" class="toplevel">Organizations</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($lowOrgs)>0)
                                        @foreach($lowOrgs as $key => $low)

                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td><a
                                                    href="{{route('admin.organization-detail',[$low->id])}}">{{$low->name}}</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <th colspan="2">No data found</th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('scripts')
<script defer>
    $('#provinceId').change(function () {

        var province = $('#provinceId').find(':selected').val();
        console.log(province);
        if (province.length > 0) {
            $.ajax({
                type: 'GET',
                url: '/admins/province/districts',
                data: {

                    province: province,
                },
                success: function (data) {
                    console.log(data)
                    $("#districtId").empty();
                    $("#districtId").append("<option value=''>Select District</option>");
                    $.each(data, function (index, value) {
                        $("#districtId").append("<option value=" + index + ">" +
                            value + "</option>");
                    });

                }
            });
        }


    });

</script>

<script defer>
    $('#ministryId').change(function () {

        var ministry = $('#ministryId').find(':selected').val();
        console.log(ministry);
        if (ministry.length > 0) {
            $.ajax({
                type: 'GET',
                url: '/admins/ministry/child-organizations',
                data: {

                    ministry: ministry,
                },
                success: function (data) {
                    console.log(data);
                    $("#departmentId").empty();
                    $("#departmentId").append("<option value=''>Select Department</option>");
                    $.each(data.departments, function (index, value) {
                        $("#departmentId").append("<option value=" + index + ">" +
                        value + "</option>");
                    });
                    $("#districtOrgId").empty();
                    $("#districtOrgId").append("<option value=''>Select District</option>");
                    $.each(data.districtOrgs, function (index, value) {
                        $("#districtOrgId").append("<option value=" + index + ">" +
                            value + "</option>");
                    });

                }
            });
        }


});

</script>


<script defer>
    $(document).ready(function () {
        $('#search').click(function () {
            // e.preventDefault();

            console.log('hereeee');

            // var fiscal_year = $(this).val();
            var fiscal_year = $('#fiscalYearSelect').find(":selected").text();
            var province = $('#provinceId').find(':selected').val();
            var district = $('#districtId').find(':selected').val();
            // var organization = $('#organization').val();

            if (fiscal_year.length > 0) {
            console.log(fiscal_year);

                $.ajax({
                    url: "{{ route('admin.filter-index') }}",

                    type: 'GET',
                    data: {
                        fiscal_year: fiscal_year,
                        province: province,
                        district: district,
                    },
                    success: function (data) {
                        $('body').html(data.html);
                        // console.log(data.province);

                    }
                });
            } else {
                $("#messageId").append("<b>No form has been verified.</b>");
            }
        });
    });

</script>
    
<script>
$(document).ready(function () {
        $('#filter').click(function () {
            // e.preventDefault();

            console.log('hereeee');

            // var fiscal_year = $(this).val();
            var fiscal_year = $('#fiscalYearSelect').find(":selected").text();
            var ministry = $('#ministryId').find(":selected").val();
            var department = $('#departmentId').find(':selected').val();
            var districtOrg = $('#districtOrgId').find(':selected').val();
            var area = $('#areaId').find(':selected').val();
            // var organization = $('#organization').val();
            console.log(fiscal_year);
            console.log(department);
            console.log(districtOrg);
            // console.log(area);
            // var organization = $('#organization').val();

            $.ajax({
                    url: "{{ route('admin.filter2') }}",

                    type: 'GET',
                    data: {
                        fiscal_year: fiscal_year,
                        ministry: ministry,
                        department: department,
                        districtOrg: districtOrg,
                        area: area,
                    },
                    success: function (data) {
                        $('body').html(data.html);
                        console.log(data);
                        // $("#departmentId").empty();
                        // $("#departmentId").append("<option value=''>Select Department</option>");
                        // $.each(data.childDepartments, function (index, value) {
                        //     $("#departmentId").append("<option value=" + index +">" +
                        //     value + "</option>");
                        // });
                        // $("#districtOrgId").empty();
                        // $("#districtOrgId").append("<option value=''>Select District</option>");
                        // $.each(data.childDistrictOrgs, function (index, value) {
                        //     $("#districtOrgId").append("<option value=" + index + ">" +
                        //         value + "</option>");
                        // });

                    }
                });
        });
    });
</script>

<!-- <script>

$('#ministryId').change((selectChildren));

const searchButtonHandler = document.querySelector('#filter');

const searchHandler = function () {
            // e.preventDefault();

            console.log('here');

            // var fiscal_year = $(this).val();
            var fiscal_year = $('#fiscalYearSelect').find(":selected").text();
            var ministry = $('#ministryId').find(":selected").val();
            var department = $('#departmentId').find(':selected').val();
            var districtOrg = $('#districtOrgId').find(':selected').val();
            var area = $('#areaId').find(':selected').val();
            // var organization = $('#organization').val();
            console.log(fiscal_year);
            console.log(department);
            console.log(districtOrg);
            console.log(area);

            
                $.ajax({
                    url: "{{ route('admin.filter2') }}",

                    type: 'GET',
                    data: {
                        fiscal_year: fiscal_year,
                        ministry: ministry,
                        department: department,
                        districtOrg: districtOrg,
                        area: area,
                    },
                    success: function (data) {
                        $('body').html(data.html);
                        console.log(data);
                        $("#departmentId").empty();
                        $("#departmentId").append("<option value=''>Select Department</option>");
                        $.each(data.childDepartments, function (index, value) {
                            $("#departmentId").append("<option value=" + index +">" +
                            value + "</option>");
                        });
                        $("#districtOrgId").empty();
                        $("#districtOrgId").append("<option value=''>Select District</option>");
                        $.each(data.childDistrictOrgs, function (index, value) {
                            $("#districtOrgId").append("<option value=" + index + ">" +
                                value + "</option>");
                        });

                    }
                });
            
        }

searchButtonHandler.addEventListener('click', function(e){
    e.preventDefault();
    console.log('called')
    searchHandler();
})  
    // $(document).ready(function () {
    //     $('#filter').click();
    // });

</script> -->

<script defer>
    $('#districtOrgId').change(function () {

        var districtOrg = $('#districtOrgId').find(':selected').val();
        console.log(districtOrg);
        if (districtOrg.length > 0) {
            $.ajax({
                type: 'GET',
                url: '/admins/district/child-organizations',
                data: {

                    districtOrg: districtOrg,
                },
                success: function (data) {
                    console.log(data);
                    $("#areaId").empty();
                    $("#areaId").append("<option value=''>Select Area</option>");
                    $.each(data, function (index, value) {
                        $("#areaId").append("<option value=" + index + ">" +
                        value + "</option>");
                    });
                    

                }
            });
        }


    });
</script>
@endsection
