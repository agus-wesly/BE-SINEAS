@extends('layouts.admin')
@section('content')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-sm">
                <a class="btn btn-success" href="{{ route('movie.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.film.title_singular') }}
                </a>
            </div>
        </div>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr class="text-center">
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.film.title_singular') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.duration') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.url_trailer') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.url_film') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.author') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.sutradara') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.produser') }}
                            </th>
                            <th>
                                {{ trans('cruds.film.fields.film_date') }}
                            </th>
                            <th class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($films as $key => $film)
                            <tr data-entry-id="{{ $film->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $film->title ?? '' }}
                                </td>
                                <td>
                                    {{ $film->duration ?? '' }}
                                </td>
                                <td>
                                    {{ $film->desc ?? '' }}
                                </td>
                                <td>
                                    {{ $film->url_trailer ?? '' }}
                                </td>
                                <td>
                                    {{ $film->url_film ?? '' }}
                                </td>
                                <td>
                                    {{ $film->penulis ?? '' }}
                                </td>
                                <td>
                                    {{ $film->sutradara ?? '' }}
                                </td>
                                <td>
                                    {{ $film->produser ?? '' }}
                                </td>
                                <td>
                                    {{ $film->date ?? '' }}
                                </td>
                                <td class="d-flex justify-content-center">
                                        <a class="btn btn-xs btn-primary mr-2"
                                            href="#">
                                            {{ trans('global.view') }}
                                        </a>

                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('movie.edit', $film->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
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
