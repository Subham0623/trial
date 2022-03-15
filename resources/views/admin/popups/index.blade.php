@extends('layouts.admin')
@section('content')
@can('popup_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.popups.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.popup.title_singular') }}
            </a>
        </div>
    </div>
@endcan 
<div class="card">
    <div class="card-header">
        {{ trans('cruds.popup.title_singular') }} {{ trans('global.list') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Popup">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.popup.fields.sn') }}
                        </th>
                        <th>
                            {{ trans('cruds.popup.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.popup.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.popup.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($popups as $key => $popup)
                        <tr data-entry-id="{{ $popup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index+1 ?? '' }}
                            </td>
                            <td>
                                {{ $popup->name ?? '' }}
                            </td>
                            <td>
                                @if($popup->status == 0)
                                    Active
                                @else
                                    Deactive
                                @endif
                            </td>
                            <td>
                                @if($popup->photo)
                                    <a href="{{ $popup->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $popup->photo->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('popup_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.popups.show', $popup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('popup_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.popups.edit', $popup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('popup_delete')
                                    <form action="{{ route('admin.popups.destroy', $popup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('popup_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.popups.massDestroy') }}",
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
  $('.datatable-Popup:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection