@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Organization Details
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- you are logged in -->
                </div>

                <div class="row container">
                    <!-- <div class="col-sm-3">
                        <div class="home-title"><span class="">PLGSP|</span><span class=""
                                style="font-size: 18px; font-weight: bold; color: black; margin-left: 5px;">Home</span>
                        </div>
                    </div> -->
                    <div class="col-sm-3">
                        <div class="position-relative form-group"><select name="fiscal_year" id="fiscalYearSelect"
                                class="form-control">
                                <option value="" disabled>Select Fiscal Year</option>
                                @foreach($years as $key => $year)
                                <option value="{{$key+1}}" {{$fiscal_year == $year ? 'selected' : ''}}>{{$year}}</option>
                                @endforeach
                            </select></div>
                    </div>

                    <!-- <div class="col-sm-2">
                        <div class="position-relative form-group"><select placeholder="पालिका चयन गर्नुहोस"
                                name="palikaId" id="palikaId" class="form-control">
                                <option value="0" disabled="">पालिका चयन गर्नुहोस</option>
                            </select></div>
                    </div> -->
                </div>

                <div class="card-layout container pb-5">
                    <h4 class="sub-heading">Organization Information</h4>
                    <div class="progress-section">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-detail list-group">
                                <li class="list-group-item">
                                        <h5>Name</h5> <span>{{$organization->name ?? ''}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>Address</h5>
                                        <span>{{$organization->address ?? ''}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>Province</h5> <span>{{$organization->province->name}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>District</h5> <span>{{$organization->district->name}}</span>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <h5>Contact</h5>
                                        <span>{{$organization->contact}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-layout container">
                    <div class="row">
                        <div class="col mb-3 col-12 text-center">
                            <div class="row table-heading">
                                <div class="col-md-6">
                                    <h6 class="sub-heading">Marks for each subject area</h6>
                                </div>
                            </div>
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th id="fam" style = "width:100%;">S.N. </th>
                                        <th id="fam">Subject Area</th>
                                        <th id="rmc">Marks by user</th>
                                        <th id="rmc">Marks by verifier</th>
                                        <th>Marks by auditor</th>
                                        <th id="es">Marks by final verifier</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @if($form !== null)
                                    @foreach($form_subject_area as $key => $item)

                                    @php
                                    $subjectArea = App\SubjectArea::where('id',$item->subject_area_id)->first();
                                    $i = 1;
                                    @endphp

                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td style="min-width: 180px;">{{$subjectArea->title}}</td>
                                        <td style="min-width: 180px;">{{$item->marks ?? ''}}</td>
                                        <td style="min-width: 180px;">{{$item->marksByVerifier ?? ''}}</td>
                                        <td style="min-width: 180px;">{{$item->marksByAuditor ?? ''}}</td>
                                        <td style="min-width: 180px;">{{$item->marksByFinalVerifier ?? ''}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <th colspan="6">No data found</th>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card-layout container">
                    <div class="row">
                        <div class="col mb-3 col-12 text-center">
                            <div class="row table-heading">
                                <div class="col-md-6">
                                    <h6 class="sub-heading">Form Detail</h6>
                                </div>
                            </div>
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th id="fam">S.N. </th>
                                        <th id="fam">Parameters</th>
                                        <th id="fr">Is Applicable?</th>
                                        <th id="rmc">Marks by user</th>
                                        <th id="rmc">Marks by verifier</th>
                                        <th>Marks by auditor</th>
                                        <th id="es">Marks by final verifier</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @if($form !== null)
                                    @foreach($form_subject_area as $subjectArea)
                                    @foreach($subjectArea->parameters as $key => $parameter)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td style="min-width: 180px;">{{$parameter->title}}</td>
                                        <td style="min-width: 180px;">
                                            {{$parameter->pivot->is_applicable == 0 ? 'Yes' : 'No'}}
                                        </td>
                                        <td style="min-width: 180px;">{{$parameter->pivot->marks ?? ''}}</td>
                                        <td style="min-width: 180px;">{{$parameter->pivot->marksByVerifier ?? ''}}</td>
                                        <td style="min-width: 180px;">{{$parameter->pivot->marksByAuditor ?? ''}}</td>
                                        <td style="min-width: 180px;">{{$parameter->pivot->marksByFinalVerifier ?? ''}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @else
                                    <tr>
                                        <th colspan="7">No data found</th>
                                    </tr>
                                    @endif
                                </tbody>
                                <input type="hidden" value="{{$organization->id}}" id="organization">
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
<script>
    $(document).ready(function () {
        $('#fiscalYearSelect').change(function () {
            // e.preventDefault();

            console.log('here');

            // var fiscal_year = $(this).val();
            var fiscal_year = $('#fiscalYearSelect').find(":selected").text();
            var organization = $('#organization').val();
            console.log(fiscal_year);

            if (fiscal_year.length > 0) {
                $.ajax({
                    url: "{{ route('admin.filter') }}",

                    type: 'GET',
                    data: {
                        fiscal_year: fiscal_year,
                        organization: organization,
                    },
                    success: function (data) {
                        $('body').html(data.html);
                    }
                });
            }
        });
    });

</script>
@endsection
