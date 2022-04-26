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
                    <div class="alert alert-success" role="alert" id="messageId">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- you are logged in -->
                </div>
                <div id = "messageId" class="container"></div>
                <div class="row container">
                    <!-- <div class="col-sm-3">
                        <div class="home-title"><span class="">PLGSP|</span><span class=""
                                style="font-size: 18px; font-weight: bold; color: black; margin-left: 5px;">Home</span>
                        </div>
                    </div> -->
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">

                        <a class="btn btn-primary" id="search">Search</a>
                    </div>
                    <!-- <div class="col-sm-2">
                        <div class="position-relative form-group"><select placeholder="पालिका चयन गर्नुहोस"
                                name="palikaId" id="palikaId" class="form-control">
                                <option value="0" disabled="">पालिका चयन गर्नुहोस</option>
                            </select></div>
                    </div> -->
                </div>

                <div class="row container">
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
                </div>

                <div class="card-layout container">
                    <div class="row">
                        <div class="col mb-3 col-6 text-center">
                            <div class="row table-heading">
                                <div class="col-md-6">
                                    <h6 class="sub-heading">10 organizations with highest score</h6>
                                </div>
                            </div>
                            <div class="row container">

                                <table class="table table-responsive table-bordered my-custom__table">
                                    <thead>
                                        <tr>
                                            <th class="toplevel">S.N. </th>
                                            <th id="fam" style="width: 100%;" class="toplevel">Organizations</th>
                                            <!-- <th id="rmc" class="toplevel"  style="border-bottom: none;">कुल
                                                प्राप्तांक (औसत)</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($topOrgs)>0)
                                        @foreach($topOrgs as $key => $top)

                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td style="min-width: 180px;"><a
                                                    href="{{route('admin.organization-detail',[$top->id])}}">{{$top->name}}</a>
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

                        <div class="col mb-3 col-6 text-center">
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
                                            <!-- <th id="rmc" class="toplevel"  style="border-bottom: none;">कुल
                                                प्राप्तांक (औसत)</th> -->
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
                        </div>

                    </div>
                </div>


                <div class="card-layout container">
                    <div class="row">


                        <div class="col mb-3 col-12 text-center">
                            <div class="row table-heading">
                                <div class="col-md-12">
                                    <h6 class="sub-heading">Total Marks of all the organizations based on subject areas
                                    </h6>
                                </div>
                            </div>
                            <div class="row container table-responsive">
                                <table class="table  table-bordered">
                                    <thead>
                                        <tr>
                                            <th id="fam" class="toplevel">S.N. </th>
                                            <th id="fam" class="toplevel">Subject Areas</th>
                                            <th>Total Marks</th>
                                            <!-- <th id="rmc" class="toplevel"  style="border-bottom: none;">कुल
                                                प्राप्तांक (औसत)</th> -->
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
                                        $subjectAreaTotal = $parameter->activeOptions()->max('points') + $subjectAreaTotal;
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
                                            <th scope="row">{{$key+1}}</th>
                                            <td style="min-width: 180px;">{{$subjectArea->title}}</td>
                                            <td style="min-width: 180px;">{{$percentage}}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('scripts')
<script>
     $('#provinceId').change(function() {
    
    var province = $('#provinceId').find(':selected').val();
    console.log(province);
    if(province .length > 0)
    {
        $.ajax({
               type:'GET',
               url:'/admins/province/districts',
               data:{
                
                   province: province,
               },
               success:function(data) {
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
<script>
    $(document).ready(function () {
        $('#search').click(function () {
            // e.preventDefault();

            console.log('here');

            // var fiscal_year = $(this).val();
            var fiscal_year = $('#fiscalYearSelect').find(":selected").text();
            var province = $('#provinceId').find(':selected').val();
            var district = $('#districtId').find(':selected').val();
            // var organization = $('#organization').val();
            console.log(fiscal_year);
            console.log(province);
            console.log(district);

            if (fiscal_year.length > 0) {
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
            }
            else
            {
                $("#messageId").append("<b>No form has been verified.</b>");
            }
        });
    });

</script>
@endsection
