@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-sm">
            <a class="btn btn-success" href="{{ route('taxes.create') }}">
                {{ trans('global.add') }} Taxes
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Taxes {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('global.name') }}
                            </th>
                            <th>
                                {{ trans('global.price') }}
                            </th>
                            <th>
                                {{ trans('global.status') }}
                            </th>
                            <th class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($taxes as $key => $tax)
                            <tr data-entry-id="{{ $tax->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $tax?->name }}
                                </td>
                                <td>
                                    {{ $tax?->price }}
                                </td>
                                <td>
                                    {{ \App\Models\Tax::STATUS_ACTIVE[$tax?->status] }}
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('taxes.edit', $tax?->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('taxes.destroy', $tax?->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;" class="ml-2">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Role:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
