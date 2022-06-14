@extends('layouts.admin')
@section('content')
@can('subject_area_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.subject-areas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.subjectarea.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.subjectarea.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SubjectArea">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.subjectarea.fields.sn') }}
                        </th>
                        <th>
                            {{ trans('cruds.subjectarea.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.subjectarea.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subject_areas as $key => $subject)
                        <tr data-entry-id="{{ $subject->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index+1 ?? '' }}
                            </td>
                            <td>
                                {{ $subject->title ?? '' }}
                            </td>
                            <td>
                                <input data-id="{{$subject->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $subject->status ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('subject_area_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.subject-areas.show', $subject->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('subject_area_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.subject-areas.edit', $subject->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('subject_area_delete')
                                    <form action="{{ route('admin.subject-areas.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('subject_area_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.subject-areas.massDestroy') }}",
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
  $('.datatable-SubjectArea:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
<script>
    $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var subjectArea_id = $(this).data('id'); 
         
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('admin.changeStatus')}}",
            data: {'status': status, 'subjectArea_id': subjectArea_id, "_token": "{{ csrf_token() }}"},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  });
</script>
@endsection