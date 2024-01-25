@extends('layouts.admin')
@section('styles')
    <!-- Other head elements -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
             Film Views
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Film-Views">
                    <thead>
                        <tr class="text-center">
                            <th width="10">

                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Views
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmViews as $key => $film)
                            <tr data-entry-id="{{ $film->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $film->title ?? '' }}
                                </td>
                                <td>
                                    {{ $film->film_view_count ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
             Transactions
        </div>

        <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="dt-buttons">
                <a id="btn-download-transactions-chart" class="btn buttons-html5 btn-default" tabindex="0" download='Transactions.png'>
                    <span>PNG</span>
                </a>
            </div>
            <div class="dataTables_filter">
                <label>Date: <input type="date" id="transactions-start-date" class="form-control form-control-sm" placeholder=""> - <input type="date" id="transactions-end-date" class="form-control form-control-sm" placeholder=""></label>
            </div>
        </div>
        <canvas id="transactions-chart"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
             Film Sellings
        </div>

        <div class="card-body">
            <p><b>Films with Active Sellings:</b> {{ $filmsWithSellings['active']->count() }}</p>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Film-Active-Sellings">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                Title
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmsWithSellings['active'] as $key => $film)
                            <tr data-entry-id="{{ $film->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $film->title ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p><b>Films with Coming Soon Sellings:</b> {{ $filmsWithSellings['comingsoon']->count() }}</p>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Film-Coming-Soon-Sellings">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                Title
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmsWithSellings['comingsoon'] as $key => $film)
                            <tr data-entry-id="{{ $film->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $film->title ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p><b>Films with Expired Sellings:</b> {{ $filmsWithSellings['expired']->count() }}</p>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Film-Expired-Sellings">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                Title
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmsWithSellings['expired'] as $key => $film)
                            <tr data-entry-id="{{ $film->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $film->title ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p><b>Films with No Sellings:</b> {{ $filmsWithSellings['expired']->count() }}</p>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Film-No-Sellings">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                Title
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filmsWithNoSellings as $key => $film)
                            <tr data-entry-id="{{ $film->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $film->title ?? '' }}
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
                pageLength: 25,
            });
            let film_views_table = $('.datatable-Film-Views:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            });
            let film_active_sellings_table = $('.datatable-Film-Active-Sellings:not(.ajaxTable)').DataTable({
                searching: false,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
            });
            let film_coming_soon_sellings_table = $('.datatable-Film-Coming-Soon-Sellings:not(.ajaxTable)').DataTable({
                searching: false,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
            });
            let film_expired_sellings_table = $('.datatable-Film-Expired-Sellings:not(.ajaxTable)').DataTable({
                searching: false,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
            });
            let film_no_sellings_table = $('.datatable-Film-No-Sellings:not(.ajaxTable)').DataTable({
                searching: false,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

        let transactionsWithoutTax = {{ Js::from($transactions['transactionsWithoutTax']) }}
        let transactionsWithTax = {{ Js::from($transactions['transactionsWithTax']) }}
        let taxes = {{ Js::from($transactions['taxes']) }}
        let labels = Object.keys(transactionsWithoutTax)
        let transactionsWithoutTaxData = Object.values(transactionsWithoutTax)
        let transactionsWithTaxData = Object.values(transactionsWithTax)
        let taxesData = Object.values(taxes)

        const transactionsChartConfig = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Transactions without Tax',
                        data: transactionsWithoutTaxData,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgb(75, 192, 192)',
                    },
                    {
                        label: 'Transactions with Tax',
                        data: transactionsWithTaxData,
                        backgroundColor: 'rgb(54, 162, 235)',
                        borderColor: 'rgb(54, 162, 235)',
                    },
                    {
                        label: 'Taxes',
                        data: taxesData,
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                    },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                animation: {
                    onComplete: () => {
                        let url = transactionsChart.toBase64Image();
                        document.getElementById("btn-download-transactions-chart").href = url;
                    }
                }
            }
        };

        let transactionsChart = new Chart(
            document.getElementById('transactions-chart'),
            transactionsChartConfig
        );

        const today = new Date();
        const startDate = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
        const formattedStartDate = startDate.toISOString().split('T')[0];
        const formattedEndDate = today.toISOString().split('T')[0];

        document.getElementById('transactions-start-date').value = formattedStartDate;
        document.getElementById('transactions-end-date').value = formattedEndDate;

        $('#transactions-start-date, #transactions-end-date').change(function() {
            let startDate = $('#transactions-start-date').val()
            let endDate = $('#transactions-end-date').val()
            if (startDate < endDate) {
                $.ajax({
                    url: '{{ route("dashboard") }}',
                    type: 'GET',
                    data: {
                        startDate: startDate,
                        endDate: endDate,
                    },
                    success: function(data) {
                        transactionsChartConfig.data.labels = Object.keys(data.transactionsWithoutTax)
                        transactionsChartConfig.data.datasets[0].data = Object.values(data.transactionsWithoutTax)
                        transactionsChartConfig.data.datasets[1].data = Object.values(data.transactionsWithTax)
                        transactionsChartConfig.data.datasets[2].data = Object.values(data.taxes)
                        transactionsChart.update()
                    }
                })
            } else {
                alert('Start date must be less than end date!')
            }
        })
    </script>
@endsection
