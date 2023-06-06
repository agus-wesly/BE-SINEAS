@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transaction.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr class="text-center">
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.user_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.code') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.title_film') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.payment_method') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.payment_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.taxes') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.subtotal') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $transaction?->id }}
                                </td>
                                <td>
                                    {{ $transaction?->user?->name }}
                                </td>
                                <td>
                                    {{ $transaction?->code }}
                                </td>
                                <td>
                                    {{ $transaction?->title_film }}
                                </td>
                                <td>
                                    {{ $transaction?->payment_method }}
                                </td>
                                <td>
                                    {{ $transaction?->payment_status }}
                                </td>
                                <td>
                                    {{ $transaction?->tax }}
                                </td>
                                <td>
                                    {{ $transaction?->subtotal }}
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
                pageLength: 100,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
