@extends('layouts.admin')
@section('content')
@can('organization_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.organizations.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.organization.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        <div class ="row">

            <div class="col">
    
                {{ trans('cruds.organization.title_singular') }} {{ trans('global.list') }}
            </div>
            <div class="col">
                <div class="row">
                    <div>
                        <select name="level" id="level">
                            <option value = "">Select Level of the Organization</option>
                            @foreach($types as $type)
                                <option class = "levels" value="{{ $type->id }}" {{ $selected_level === $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                            @endforeach
                        </select>
                        <a class="btn btn-primary" id="search">Search</a>
                    </div>
                </div>
                <!-- <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import Organization Data</button>
                    <a href = "{{asset('/organizations.xlsx')}}"class="btn btn-success" style="color:white">Download Format</a>
                </form>   -->

            </div>
        </div>
    </div>
    

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Organization">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.sn') }}
                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.province') }}
                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.district') }}
                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.organization.fields.contact') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizations as $key => $organization)
                        <tr data-entry-id="{{ $organization->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index+1 ?? '' }}
                            </td>
                            <td>
                                {{ $organization->name ?? '' }}
                            </td>
                            <td>
                                {{ $organization->province ? $organization->province->name : '' }}
                            </td>
                            <td>
                                {{ $organization->district ? $organization->district->name : '' }}
                            </td>
                            <td>
                                {{ $organization->type ? $organization->type->title : '' }}
                            </td>
                            <td>
                                {{ $organization->address ?? '' }}
                            </td>
                            <td>
                                {{ $organization->contact ?? '' }}
                            </td>
                            <td>
                                @can('organization_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.organizations.show', $organization->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('organization_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.organizations.edit', $organization->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('organization_delete')    
                                    <form action="{{ route('admin.organizations.destroy', $organization->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('organization_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.organizations.massDestroy') }}",
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
  $('.datatable-Organization:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
<script>
    $("#search").click(function(){
            var selected_level = $('#level').val();
            console.log(selected_level);

            if(selected_level == '' )
            {
                alert('select any option first');
            }
            else{

                $.ajax({
                        url: "{{route('admin.type-organizations')}}",
                        type: "GET",
                        dataType: "json",
                        data:{
                            'type': selected_level,
                        },
                        success:function(data) {
                            console.log(data);
                            $('body').html(data.html);
                        }
                        });
            }


                    
                
        });
</script>
@endsection