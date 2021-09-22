@extends('layouts.admin')
@section('content')
@can('contact_company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contact-companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contactCompany.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contactCompany.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ContactCompany">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_website') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contactCompanies as $key => $contactCompany)
                        <tr data-entry-id="{{ $contactCompany->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $contactCompany->id ?? '' }}
                            </td>
                            <td>
                                {{ $contactCompany->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $contactCompany->company_address ?? '' }}
                            </td>
                            <td>
                                {{ $contactCompany->company_website ?? '' }}
                            </td>
                            <td>
                                {{ $contactCompany->company_email ?? '' }}
                            </td>
                            <td>
                                @can('contact_company_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.contact-companies.show', $contactCompany->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('contact_company_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.contact-companies.edit', $contactCompany->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('contact_company_delete')
                                    <form action="{{ route('admin.contact-companies.destroy', $contactCompany->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('contact_company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contact-companies.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ContactCompany:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection