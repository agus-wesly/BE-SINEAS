@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-sm">
            <a class="btn btn-success" href="{{ route('film-selling-price.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.filmSellingPrice.title_singular') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.filmSellingPrice.title') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.filmSellingPrice.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSellingPrice.fields.duration') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSellingPrice.fields.price') }}
                            </th>
                            <th class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmSellingPrices as $key => $filmSellingPrice)
                            <tr data-entry-id="{{ $filmSellingPrice->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $filmSellingPrice?->name }}
                                </td>
                                <td>
                                    {{ $filmSellingPrice?->duration }}
                                </td>
                                <td>
                                    {{ $filmSellingPrice?->price }}
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('film-selling-price.edit', $filmSellingPrice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('film-selling-price.destroy', $filmSellingPrice->id) }}" method="POST"
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
