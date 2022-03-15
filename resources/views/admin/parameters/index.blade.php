@extends('layouts.admin')
@section('content')
@can('parameter_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.parameters.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.parameter.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.parameter.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-parameter">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.parameter.fields.sn') }}
                        </th>
                        <th>
                            {{ trans('cruds.parameter.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.parameter.fields.subject_area') }}
                        </th>
                        <th>
                            {{ trans('cruds.parameter.fields.sort') }}
                        </th>
                        <th>
                            {{ trans('cruds.parameter.fields.option') }}
                        </th>
                        <th>
                            {{ trans('cruds.parameter.fields.document') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parameters as $key => $parameter)
                        <tr data-entry-id="{{ $parameter->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index+1 ?? '' }}
                            </td>
                            <td>
                                {{ $parameter->title ?? '' }}
                            </td>
                            <td>
                                {{ ($parameter->subjectArea) ? $parameter->subjectArea->title : '' }}
                            </td>
                            <td>
                                {{ $parameter->sort ?? '' }}
                            </td>
                            <td>
                                @foreach($parameter->options as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($parameter->documents as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('parameter_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.parameters.show', $parameter->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('parameter_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.parameters.edit', $parameter->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('parameter_delete')    
                                    <form action="{{ route('admin.parameters.destroy', $parameter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('parameter_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.parameters.massDestroy') }}",
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
  $('.datatable-parameter:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection