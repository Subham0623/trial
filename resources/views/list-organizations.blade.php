@extends('layouts.admin')
@section('content')
<div class="row" class="main-list">
                    <div class="col-sm-3">
                        <div class="position-relative form-group"><select name="fiscal_year" id="fiscalYearSelect"
                                class="form-control filter">
                                <option value="" disabled>Select Fiscal Year</option>
                                @foreach($years as $key => $year)
                                <option value="{{$year}}"{{ $year == $fiscal_year ? 'selected' : '' }} >{{$year}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="position-relative form-group"><select placeholder="Select Ministry" name="ministry"
                            id="ministryId" class="form-control filter">
                            <option value="">--- मन्त्रालय/सङ्‍घीय निकाय ---</option>
                            @foreach($ministry as $item)
                            <option value="{{$item->id}}" {{ $item->id == $ministry_id ? 'selected' : '' }}>
                                {{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="position-relative form-group"><select placeholder="Select Department" name="department"
                            id="departmentId" class="form-control filter">
                            <option value="">--- विभाग/विभागस्तरीय कार्यालय ---</option>
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
                        </select>
                    </div>
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
                        <a class="btn btn-primary" id="filter" style="color: #fff">खोज्नुहोस्</a>
                    </div>
</div>

<div class="card-body">
    <div class="col-md-12">
        <h4 class="sub-heading"> आ.व. {{ $fiscal_year }} मा व्यवस्थापन परीक्षणको मूल्याङ्कनका आधारमा निकायगत स्तर वर्गीकरण सम्बन्धी विवरण </h4>
    </div>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-list">

            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        क्र.सं.
                    </th>
                    <th>
                        कार्यालयको नाम
                    </th>
                    <th id="rmc">
                        सूचक संख्या
                    </th>
                    <th id="rmc">
                        पूर्णाङ्क
                    </th>
                    <th>
                        प्राप्ताङ्‍क
                    </th>
                    <th>
                        प्राप्ताङ्क प्रतिशत
                    </th>
                    <th>
                        स्तर
                    </th>
                    <th>
                        ग्रेड
                    </th>
                    <th>
                        प्रतिवेदन हेर्नुहोस्
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_param = App\Parameter::where('status',1)->count();

                @endphp
                @foreach($published_forms as $key => $item)
                    <tr data-entry-id="{{ $item->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $key+1 }}
                        </td>
                        <td>
                            {{ $item->organization ? $item->organization->name : '' }}
                        </td>
                        <td>
                            {{$total_param}}
                        </td>
                        <td>
                            {{$total_param}}
                        </td>
                        <td>
                            {{$item->total_marks_finalVerifier ?? ''}}
                        </td>
                        <td>
                            {{round(($item->total_marks_finalVerifier / $total_param)*100,2)}} %
                        </td>
                        <td>
                            {{$item->remarks ?? ''}}
                        </td>
                        <td>
                            {{$item->grade}}
                        </td>
                        <td>
                            <a class="text-heading font-semibold"
                                href="{{route('admin.organization-detail',[$item->organization->id])}}">प्रतिवेदन फाइल
                            </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


<!-- <div class="card-layout container-fluid mt-3">
                    <div class="row custom__table-alignment">
                        <div class="card shadow border-0 text-center overflow-hidden custom__table-alignment-first"
                            style="padding:0">
                            <div class="row table-heading w-100" style="transform: translateX(15px);">
                                <div class="card-header" style="width: 100%; background: #fff">
                                    <h6 class="sub-heading">व्यवस्थापन परीक्षण गरिएका कार्यालयहरू
                                    </h6>
                                </div>
                            </div>
                            <div class="row table-responsive" style="transform: translateX(15px); height: 100%">
                                <table class="table table-hover table-nowrap"
                                    style="flex: 1; margin-bottom: 0; height:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="border:none">क्र.सं.</th>
                                            <th scope="col" style="border:none">कार्यालयको नाम</th>
                                            <th scope="col" style="border:none">प्राप्ताङ्‍क</th>
                                            <th scope="col" style="border:none">ग्रेड</th>
                                            <th scope="col" style="border:none">प्रतिवेदन हेर्नुहोस्</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($published_forms)>0)
                                        @foreach($published_forms as $key => $item)
                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>
                                                {{$item->organization ? $item->organization->name : '' }}
                                            </td>
                                            <td>
                                                {{$item->total_marks_finalVerifier ?? ''}}
                                            </td>
                                            <td>
                                                {{$item->grade}}
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold"
                                                    href="{{route('admin.organization-detail',[$item->organization->id])}}">प्रतिवेदन फाइल
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>Data not found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
</div> -->
@endsection

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-list:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
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
                    $("#departmentId").append("<option value=''>--- विभाग/विभागस्तरीय कार्यालय ---</option>");
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
                    url: "/admins/filter/list-organizations",

                    type: 'GET',
                    data: {
                        fiscal_year: fiscal_year,
                        ministry: ministry,
                        department: department,
                        districtOrg: districtOrg,
                    },
                    success: function (data) {
                        console.log(data);
                        $('body').html(data.html);
                        console.log(data);

                    }
                });
        });
    });
</script>
@endsection
