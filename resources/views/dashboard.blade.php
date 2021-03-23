<x-app-layout>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="card mb-2">
                <h4 class="card-header"><i class="far fa-calendar-alt mr-1"></i>
                    <span class="d-none d-md-inline">@lang('dashboard.calendar-for')</span> {{$setToDay->translatedFormat('F Y')}}
                </h4>
                <div class="card-body">
                    <div class="text-center" role="toolbar" aria-label="Toolbar with button year">
                        <a href="/dashboard/{{$year-1}}/{{$month}}" class="btn btn-outline-success my-1">
                            <i class="fas fa-chevron-left"></i>
                            <span class="d-none d-md-inline">@lang('dashboard.previous-year')</span>
                        </a>
                        <a href="/dashboard/{{$current->format('Y')}}/{{$month}}"
                           class="btn btn-outline-success my-1">
                            <span class="d-md-inline">@lang('dashboard.current-year')</span>
                            <i class="fas fa-calendar-check"></i>
                        </a>
                        <a href="/dashboard/{{$year+1}}/{{$month}}" class="btn btn-outline-success my-1">
                            <span class="d-none d-md-inline">@lang('dashboard.next-year')</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="text-center">
                        @foreach ( $monthsList as $item)
                            <a href="/dashboard/{{$year}}/{{ $loop->index+1 }}"
                               class="btn btn-outline-primary my-1 {{$loop->index+1==$month ? 'active' : null}}">{{ $item }}</a>
                        @endforeach
                    </div>

                    @include('errors.fields')

                    {!! $calendar !!}

                </div>
            </div>


            <div class="card mb-2">
                <div class="card-header">
                    <i class="fas fa-chart-area mr-1"></i>
                    @lang('dashboard.show-stat-by-month')
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header" role="button" data-toggle="collapse" data-target="#all-sum" aria-expanded="true" aria-controls="all-sum">
                            <i class="fas fa-funnel-dollar mr-1"></i>
                            @lang('dashboard.show-all-sum-costs-incomes')
                        </div>
                        <div class="card-body collapse" id="all-sum">
                            <div class="col-md-6">@lang('dashboard.show-all-income-for-the-current-period') <span class="text-success">+{{$amountsIncomes}}</span></div>
                            <div class="col-md-6">@lang('dashboard.show-all-expenses-for-the-current-period') <span class="text-danger">-{{$amountsCosts}}</span></div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header" role="button" data-toggle="collapse" data-target="#table-type" aria-expanded="true" aria-controls="table-type">
                            <svg class="svg-inline--fa fa-table fa-w-16 mr-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg><!-- <i class="fas fa-table mr-1"></i> Font Awesome fontawesome.com -->
                                @lang('dashboard.show-all-list-costs-incomes')
                        </div>
                        <div class="card-body collapse" id="table-type">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable">
                                                <thead>
                                                <tr role="row">
                                                    <th style="width: 50%;">@lang('template.type-incomes')</th>
                                                    <th style="width: 50%;">@lang('incomes-costs.sum')</th>
                                                </thead>
                                                <tbody>
                                                @foreach ( $allIncomes as $key => $items)
                                                        <tr role="row" class="{{(($loop->index % 2) == 0) ? 'odd' : 'even'}}">
                                                            <td class="sorting_1">{{$items['type-name']}}</td>
                                                            <td>{{$items['amount']}}</td>
                                                        </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered dataTable">
                                                <thead>
                                                <tr role="row">
                                                    <th style="width: 50%;">@lang('template.type-costs')</th>
                                                    <th style="width: 50%;">@lang('incomes-costs.sum')</th>
                                                </thead>
                                                </tfoot>
                                                <tbody>
                                                @foreach ( $allCosts as $key => $items)
                                                    <tr role="row" class="{{(($loop->index % 2) == 0) ? 'odd' : 'even'}}">
                                                        <td class="sorting_1">{{$items['type-name']}}</td>
                                                        <td>{{$items['amount']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-header" role="button" data-toggle="collapse" data-target="#chart-area" aria-expanded="true" aria-controls="chart-area">
                            <i class="fas fa-chart-area mr-1"></i>
                            @lang('dashboard.show-chart-of-expenses-and-income-for-the-selected-period')
                        </div>
                        <div class="card-body collapse" id="chart-area">
                            <canvas id="myAreaChart" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated {{$current}}</div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                        crossorigin="anonymous"></script>
                <script>
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';
                    let ctx = document.getElementById("myAreaChart");
                    let myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [
                                @foreach ($dayData as $dayItem)
                                    @if ($dayItem['tempDate']->month === $dayItem['today']->month)
                                        "{{$dayItem['tempDate']->translatedFormat('l')}} - {{$dayItem['tempDate']->day}} {{$dayItem['tempDate']->translatedFormat('M')}}",
                                    @endif
                                @endforeach
                            ],
                            datasets: [{
                                    label: "Incomes {{$dayItem['settings']['currency']['value-text']??''}}",
                                lineTension: 0.3,
                                backgroundColor: "rgba(40,167,69,0.3)",
                                borderColor: "rgba(40,167,69,1)",
                                pointRadius: 5,
                                pointBackgroundColor: "rgba(40,167,69,1)",
                                pointBorderColor: "rgba(255,255,255,0.8)",
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(40,167,69,1)",
                                pointHitRadius: 50,
                                pointBorderWidth: 3,
                                data: [
                                    @foreach ($dayData as $dayItem)
                                        @if ($dayItem['tempDate']->month === $dayItem['today']->month)
                                            "{{ $dayItem['amountsIncomeByDay']}}",
                                        @endif
                                    @endforeach
                                ],
                            }, {
                                label: "Costs {{$dayItem['settings']['currency']['value-text']??''}}",
                                lineTension: 0.3,
                                backgroundColor: "rgba(220,53,69,0.2)",
                                borderColor: "rgba(220,53,69,1)",
                                pointRadius: 5,
                                pointBackgroundColor: "rgba(220,53,69,1)",
                                pointBorderColor: "rgba(255,255,255,0.8)",
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(220,53,69,1)",
                                pointHitRadius: 50,
                                pointBorderWidth: 2,
                                data: [
                                    @foreach ($dayData as $dayItem)
                                        @if ($dayItem['tempDate']->month === $dayItem['today']->month)
                                            "-{{ $dayItem['amountsCostsByDay']}}",
                                        @endif
                                    @endforeach
                                ],
                            }],
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'date'
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 7
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        min: -1000 -{{$maxCosts}},
                                        max: 1000 +{{$maxIncome}},
                                        maxTicksLimit: 5
                                    },
                                    gridLines: {
                                        color: "rgba(0, 0, 0, .125)",
                                    }
                                }],
                            },
                            legend: {
                                display: true
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
