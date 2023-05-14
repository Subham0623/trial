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
                    <h4 class="sub-heading">Organization Information:</h4>
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
                                        <h5>Province</h5> <span>{{$organization->province ? $organization->province->name : ''}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>District</h5> <span>{{$organization->district ? $organization->district->name : ''}}</span>
                                    </li>

                                    <li class="list-group-item">
                                        <h5>Contact</h5>
                                        <span>{{$organization->contact ?? ''}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-layout container">
                    <div class="row">
                        <div class="col mb-3 col-12">
                            <div class="row table-heading">
                                <div class="col-md-12">
                                    <h4 class="sub-heading">Marks for each subject area:</h4>
                                </div>
                            </div>
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th id="fam" >क्र.सं.</th>
                                        <th id="fam" style = "width:100%;">विषयक्षेत्र</th>
                                        <th id="rmc">सूचक संख्या</th>
                                        <th id="rmc">पूर्णाङ्क</th>
                                        <th id="es">प्राप्ताङ्क</th>
                                        <th id="rmc">प्रतिशत</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @php
                                        $total_parameters = 0;
                                        $full_marks = 0;
                                        $total_marks = 0;
                                    @endphp
                                    @if($form !== null)
                                    @foreach($form_subject_area as $key => $item)

                                    @php
                                    $subjectArea = App\SubjectArea::where('id',$item->subject_area_id)->with('activeParameters')->first();
                                    $i = 1;
                                    $parameter_count = $subjectArea->activeParameters()->count();
                                    $fullmarks_subjectarea = $parameter_count;
                                    @endphp

                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td style="min-width: 180px;">{{$subjectArea->title}}</td>
                                        <td style="min-width: 180px;">{{$parameter_count}}</td>
                                        <td style="min-width: 180px;">{{$fullmarks_subjectarea}}</td>
                                        <td style="min-width: 180px;">{{$item->marksByFinalVerifier ?? ''}}</td>
                                        <td style="min-width: 180px;">{{ round(($item->marksByFinalVerifier / $fullmarks_subjectarea) * 100,2) ?? ''}} %</td>
                                    </tr>
                                    @php

                                        $total_parameters += $parameter_count;
                                        $full_marks += $fullmarks_subjectarea;
                                        $total_marks +=  $item->marksByFinalVerifier;
                                    @endphp

                                    @endforeach
                                    @else
                                    <tr>
                                        <th colspan="6">No data found</th>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <th ></th>
                                    <th style = "width:100%;">जम्मा</th>
                                    <th >{{ $total_parameters }}</th>
                                    <th >{{ $full_marks }}</th>
                                    <th >{{ $total_marks }}</th>
                                    <th >{{ round(($total_marks / $full_marks)*100,2) }} %</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card-layout container">
                    <div class="row">
                        <div class="col mb-3 col-12 ">
                            <div class="row table-heading">
                                <div class="col-md-12">
                                    <h4 class="sub-heading">Form Detail:</h4>
                                </div>
                            </div>
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th id="fam">क्र.सं.</th>
                                        <th id="fam">सूचकको नाम</th>
                                        <th id="fr">Is Applicable?</th>
                                        {{-- <th id="rmc">Self Verified Marks</th> --}}
                                        <th id="es">प्राप्ताङ्क</th>
                                        <th id="es">विषयक्षेत्र</th>
                                        <th id="es">कैफियत</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @if($form !== null)
                                    @foreach($form_subject_area as $subjectArea)
                                    @php
                                    $subjectarea = App\SubjectArea::where('id',$item->subject_area_id)->first();

                                    @endphp
                                    @foreach($subjectArea->parameters as $key => $parameter)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td style="min-width: 180px;">{{$parameter->title}}</td>
                                        <td style="min-width: 180px;">
                                            {{$parameter->pivot->is_applicable == 0 ? 'Yes' : 'No'}}
                                        </td>
                                        {{-- <td style="min-width: 180px;">{{$parameter->pivot->marksByVerifier ?? ''}}</td> --}}
                                        <td style="min-width: 180px;">{{$parameter->pivot->marksByFinalVerifier ?? ''}}
                                        </td>
                                        <td style="min-width: 180px;">{{$subjectarea->title}}</td>
                                        <td style="min-width: 180px;">{{$parameter->remarks}}</td>
                                    </tr>
                                    @php
                                        $total += $parameter->pivot->marksByFinalVerifier;
                                    @endphp
                                    @endforeach
                                    @endforeach
                                    @else
                                    <tr>
                                        <th colspan="7">No data found</th>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <th scope="row"></th>
                                    <th style="min-width: 180px;">जम्मा</th>
                                    <th style="min-width: 180px;">
                                    </th>
                                    <th style="min-width: 180px;">
                                        {{$total}}
                                    </th>
                                    <th style="min-width: 180px;"></th>
                                    <th style="min-width: 180px;"></th>
                                </tfoot>
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
