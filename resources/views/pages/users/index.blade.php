@extends('layouts.admin')
@section('content')
    @can('supplier_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-sm">
                <a class="btn btn-success" href="#">
                    {{ trans('global.add') }} {{ trans('cruds.supplier.title_singular') }}
                </a>
            </div>
{{--            <div class="col-sm">--}}
{{--                <form action="{{ route('admin.suppliers.fileImport') }}" method="POST" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                            <button class="btn btn-primary">Import data</button>--}}
{{--                                <!-- <span class="input-group-text" id="inputGroupFileAddon01">Upload</span> -->--}}
{{--                            </div>--}}
{{--                            <div class="custom-file">--}}
{{--                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="file"--}}
{{--                                    aria-describedby="inputGroupFileAddon01">--}}
{{--                                <label class="custom-file-label" for="inputGroupFile01"></label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--            </div>--}}

        </div>
    @endcan
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
                                {{ trans('global.name') }}
                            </th>
                            <th>
                                {{ trans('global.email') }}
                            </th>
                            <th>
                                {{ trans('global.telp') }}
                            </th>
                            <th>
                                {{ trans('global.role') }}
                            </th>
                            <th class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $user->telp ?? '' }}
                                </td>
                                <td>
                                    {{ $user->roles->name ?? '' }}
                                </td>
                                <td class="d-flex justify-content-center">
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('user.edit', $user->id) }}">
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
