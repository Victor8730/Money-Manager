<x-app-layout>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="card mb-2">
                <h4 class="card-header"><i class="far fa-calendar-alt mr-1"></i>
                    <span class="d-none d-md-inline">Calendar for</span> {{$setToDay->format('F Y')}}
                </h4>
                <div class="card-body">
                    <div class="text-center" role="toolbar" aria-label="Toolbar with button year">
                        <a href="/dashboard/{{$year-1}}/{{$month}}" class="btn btn-outline-success my-1">
                            <i class="fas fa-chevron-left"></i>
                            <span class="d-none d-md-inline">Previous year</span>
                        </a>
                        <a href="/dashboard/{{$current->format('Y')}}/{{$month}}"
                           class="btn btn-outline-success my-1">
                            <span class="d-md-inline">Current year</span>
                            <i class="fas fa-calendar-check"></i>
                        </a>
                        <a href="/dashboard/{{$year+1}}/{{$month}}" class="btn btn-outline-success my-1">
                            <span class="d-none d-md-inline">Next year</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="text-center">
                        @foreach ( [ 'January','February','March','April','May','June','July ','August','September','October','November','December'] as $item)
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
                    Chart of expenses and income for the selected period
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
                    <div class="col-md-6">All income for the current period <span class="text-success">+{{$allIncome}}</span></div>
                    <div class="col-md-6">All expenses for the current period <span class="text-danger">-{{$allCosts}}</span></div>
                    <canvas id="myAreaChart" class="chartjs-render-monitor"></canvas>
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
                                        "{{$dayItem['tempDate']->format('l')}} - {{$dayItem['tempDate']->day}} {{$dayItem['tempDate']->format('M')}}",
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
