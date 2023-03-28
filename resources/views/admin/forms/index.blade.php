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
                                <option class = "organizations" value="{{ $organization->id }}" {{ $org === $organization->id ? 'selected' : '' }}>{{ $organization->name }}</option>
                            @endforeach
                        </select>
                        <select name="year" id="year">
                            <option value = "">Select Year</option>
                            @foreach($years as $year)
                                <option class = "years" value="{{ $year }}" {{ $yr == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <a class="btn btn-primary" id="search">Search</a>
                    </div>
                </div>
            </div>
        </div>
        @can('access-sub-organization-forms')
        <div class="recognize-event">
                <button class="btn btn-primary" id="verified" data-id='1'>Verified Forms</button>
                <button class="btn btn-primary" id="toBeVerified" data-id='2'>To Be Verified Forms</button>
                <button class="btn btn-primary" id="child" data-id='3'>Sub-organization Forms</button>
        </div>
        @endcan
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
                            {{ trans('cruds.form.fields.audit_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.final_verified_status') }}
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
                        @can('form_publish')
                        <th>
                            Publish?
                        </th>
                        @endcan
                        <th>
                            Actions
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
                                {!! ($form->is_verified == 1) ? '<span class="badge badge-success">Submitted</span>' : ($form->is_verified == 0 ? '<span class="badge badge-info">Draft</span>' : '<span class="badge badge-danger">Reassigned</span>') !!}
                            </td>
                            <td>
                            {!! ($form->is_audited == 1) ? '<span class="badge badge-success">Audited</span>' : ($form->is_audited == 0 ? '<span class="badge badge-info">Draft</span>' : '<span class="badge badge-danger">Reassigned</span>') !!}
                            </td>
                            <td>
                                {!! ($form->final_verified == 1) ? '<span class="badge badge-success">Verified</span>' : '<span class="badge badge-info">Draft</span>' !!}</span>
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
                            @can('form_publish')
                            <td>
                                <input data-id="{{$form->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Yes" data-off="No" {{ $form->publish ? 'checked' : '' }}>
                            </td>
                            @endcan
                            <td>
                                    @can('form_edit')
                                        <a class="btn btn-xs btn-info" href="{{config('panel.homepage')}}/form/{{$form->id}}" target="_blank">
                                            @php
                                                $user_roles = auth()->user()->roles->pluck('id');

                                            @endphp
                                            @if($user_roles->contains(1) || $user_roles->contains(2))

                                                {{ trans('global.view') }} / {{ trans('global.edit') }}

                                            @elseif($user_roles->contains(4) || $user_roles->contains(5))
                                                @if($form->audited_by)

                                                    {{ trans('global.view') }}
                                                @else
                                                    {{ trans('global.audit') }}
                                                @endif

                                            @elseif($user_roles->contains(6))
                                                @if($form->verified_by)

                                                    {{ trans('global.view') }}
                                                @else
                                                    {{ trans('global.verify') }}
                                                @endif
                                            @endif
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

<script>
    $(function() {
    $('.toggle-class').change(function() {
        var publish = $(this).prop('checked') == true ? 1 : 0;
        var form_id = $(this).data('id');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('admin.form-publish')}}",
            data: {'publish': publish, 'form_id': form_id,"_token": "{{ csrf_token() }}"},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  });
</script>

<script>
    // let recognizeEvent = document.querySelector('.recognize-event');
    document.querySelector('.recognize-event').addEventListener('click', function(e){
        e.preventDefault();
        const clickedButton = e.target.closest('.btn');
        if(!clickedButton) return;
        console.log(clickedButton.dataset.id, 'sss')
        $.ajax({
                url: "{{route('admin.verified-forms')}}",
                type: "GET",
                dataType: "json",
                data:{'value':clickedButton.dataset.id},
                success:function(data)
                {
                    console.log(data);
                    $('body').html(data.html);

                }
            });

    })

    // $("#verified").click(function(){
    //     $.ajax({
    //             url: "{{route('admin.verified-forms')}}",
    //             type: "GET",
    //             dataType: "json",
    //             success:function(data)
    //             {
    //                 console.log(data);
    //                 $('body').html(data.html);

    //             }
    //         });





    //     });
</script>
@endsection
