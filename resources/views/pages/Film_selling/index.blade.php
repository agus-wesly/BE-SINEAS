@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-sm">
            <a class="btn btn-success" href="{{ route('film-selling.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.filmSelling.title_singular') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.filmSelling.title') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.filmSelling.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSelling.fields.id_film') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSelling.fields.expired_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSelling.fields.film_selling_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSelling.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.filmSelling.fields.is_fee') }}
                            </th>
                            <th class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmSellings as $key => $filmSelling)
                            <tr data-entry-id="{{ $filmSelling->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $filmSelling?->name }}
                                </td>
                                <td>
                                    {{ $filmSelling?->film?->title }}
                                </td>
                                <td>
                                    {{ $filmSelling?->expired_date }}
                                </td>
                                <td>
                                    {{ $filmSelling?->sellingPrice?->price }}
                                </td>
                                <td class="{{ $filmSelling?->status_film_selected_class }}">
                                    {{ $filmSelling?->status_film_selected }}
                                </td>
                                <td class="{{ $filmSelling?->is_free_selected_class }}">
                                    {{ $filmSelling?->is_free_selected }}
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('film-selling.edit', $filmSelling->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('film-selling.destroy', $filmSelling->id) }}" method="POST"
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
