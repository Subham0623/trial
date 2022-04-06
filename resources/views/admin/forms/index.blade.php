@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class ="row">

            <div class="col">

                {{ trans('cruds.form.title_singular') }} {{ trans('global.list') }}
            </div>
            <div class="col">
                <div class="row">
                    <div>
                        <select name="organization" id="organization">
                            <option value = "">Select Organization</option>
                            @foreach($organizations as $organization)
                                <option class = "organizations" value="{{ $organization->id }}" {{ old('organization') == $organization->id ? 'selected' : '' }}>{{ $organization->name }}</option>
                            @endforeach
                        </select>
                        <select name="year" id="year">
                            <option value = "">Select Year</option>
                            @foreach($years as $year)
                                <option class = "years" value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <a class="btn btn-primary" id="search">Search</a>
                    </div>   
                </div>
            </div>
        </div>
    </div>
        

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-form">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.form.fields.sn') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.organization') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.year') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.verified_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.audited_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.final_verified_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.total_marks') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $key => $form)
                        <tr data-entry-id="{{ $form->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>
                                {{ $form->organization ? $form->organization->name : '' }}
                            </td>
                            <td>
                                {{ $form->year ?? '' }}
                            </td>
                            <td>
                                @if($form->status == 0)
                                    <span class="badge badge-info">Draft</span>
                                @else
                                    <span class="badge badge-info">Submitted</span>
                                @endif
                            </td>
                            <td>
                                {{ $form->user ? $form->user->name : '' }}
                            </td>
                            <td>
                                {{ $form->verifiedBy ? $form->verifiedBy->name : '' }}
                            </td>
                            <td>
                                {{ $form->auditedBy ? $form->auditedBy->name : '' }}
                            </td>
                            <td>
                                {{ $form->finalVerifiedBy ? $form->finalVerifiedBy->name : '' }}
                            </td>
                            <td>
                                {{ $form->total_marks ?? '' }}
                            </td>
                            <td>
                            @can('form_edit')
                                    <a class="btn btn-xs btn-info" href="http://mangosoftsolution.com:3930/form/{{$form->id}}">
                                        {{ trans('global.audit') }}
                                    </a>
                             @endcan   
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('form_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.forms.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-form:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
<script>
    $("#search").click(function(){
            var org = $('#organization').val();
            console.log(org);
            var year = $('#year').val();
            console.log(year);

            if(org == '' && year == '')
            {
                alert('select any option first');
            }
            else{

                $.ajax({
                        url: "{{route('admin.form-filter')}}",
                        type: "GET",
                        dataType: "json",
                        data:{
                            'organization': org,
                            'year': year,
                        },
                        success:function(data) {
                            console.log(data);
                            // $("table tbody").empty();
                            $('body').html(data.html);
                            // $('tbody').html(data);
                                    // let newData = '<tbody>';
                                    // $.each(data, function(key, value) {
                                    //     newData += `
                                    //     <tr>
                                    //     <td>${key+1}</td>
                                    //     <td>${value.organization_id}</td>
                                    //     <td>${value.year}</td>
                                    //     <td>${value.status}</td>
                                    //     <td>${value.created_by}</td>
                                    //     <td>${value.}</td>
                                    //     <td><a class="btn btn-xs btn-info" href="">View Forms</a></td>
                                    //     </tr>`;
                                    // });
                                    // newData += '</tbody>';
                                    // $("#list2 table ").append(newData);
                                                        }
                                                    });
            }


                    
                
        });
</script>
@endsection