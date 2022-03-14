@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.form.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-form">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.form.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.organization') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.year') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.updated_by') }}
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
                                {{ $form->id ?? '' }}
                            </td>
                            <td>
                                {{ $form->organization ? $form->organization->name : '' }}
                            </td>
                            <td>
                                {{ $form->year ?? '' }}
                            </td>
                            <td>
                                {{ $form->user ? $form->user->name : '' }}
                            </td>
                            <td>
                                {{ $form->updatedBy ? $form->updatedBy->name : '' }}
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
                            @can('form_edit')
                                    <a class="btn btn-xs btn-info" href="{{ url('/api/v1/form', $form->id) }}">
                                        {{ trans('global.edit') }}
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-form:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection