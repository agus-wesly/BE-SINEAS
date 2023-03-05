@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-sm">
            <a class="btn btn-success" href="{{ route('banners.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.banner.title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.banner.title_singular') }} {{ trans('global.list') }}
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
                                {{ trans('global.description') }}
                            </th>
                            <th>
                                {{ trans('global.image') }}
                            </th>
                            <th>
                                {{ trans('global.url') }}
                            </th>
                            <th>
                                {{ trans('global.expired_date') }}
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
                        @foreach ($banners as $key => $banner)
                            <tr data-entry-id="{{ $banner->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $banner?->title }}
                                </td>
                                <td>
                                    {{ \Illuminate\Support\Str::limit($banner?->description, 40) }}
                                </td>
                                <td>
                                    {{ $banner?->image }}
                                </td>
                                <td>
                                    {{ $banner?->url_link }}
                                </td>
                                <td>
                                    {{ $banner?->expired_date}}
                                </td>
                                <td>
                                    {{ \App\Models\Banner::STATUS_ACTIVE[$banner->status] ?? '' }}
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('banners.edit', $banner->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('banners.destroy', $banner->id) }}" method="POST"
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
