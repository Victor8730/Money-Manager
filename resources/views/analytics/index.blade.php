<x-app-layout>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="card mb-2">
                <h4 class="card-header">
                    <i class="fas fa-chart-area mr-1"></i>
                    @lang('analytics.Chart of expenses and income for the selected period')
                </h4>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                            <div class="accordion" id="accordionAnalyticsSearch">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                               @lang('template.incomes')
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionAnalyticsSearch">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">@lang('incomes-costs.date-start')</span>
                                                            </div>
                                                            <input type="date" class="form-control" aria-label="Start date" id="start-incomes">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">@lang('incomes-costs.date-final')</span>
                                                            </div>
                                                            <input type="date" class="form-control" aria-label="Final Date" id="final-incomes">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">
                                                                    @lang('template.type-incomes')
                                                                </label>
                                                            </div>
                                                            <select class="form-control" name="type-incomes" id="type-incomes">
                                                                @foreach($incomeType as $type)
                                                                    <option
                                                                        value="{{ $type->id }}">{{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div><button type="button" class="btn btn-primary updateCharts" data-variant="incomes">@lang('incomes-costs.apply-search')</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-danger collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                @lang('template.costs')
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAnalyticsSearch">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">@lang('incomes-costs.date-start')</span>
                                                            </div>
                                                            <input type="date" class="form-control" aria-label="Start date" id="start-costs">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">@lang('incomes-costs.date-final')</span>
                                                            </div>
                                                            <input type="date" class="form-control" aria-label="Final Date" id="final-costs">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">
                                                                    @lang('template.type-costs')
                                                                </label>
                                                            </div>
                                                            <select class="form-control" name="type-costs" id="type-costs">
                                                                @foreach($costsType as $type)
                                                                    <option value="{{ $type->id }}">
                                                                        {{ $type->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div><button type="button" class="btn btn-primary updateCharts" data-variant="costs">@lang('incomes-costs.apply-search')</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="text-center"><h3 id="show-amount"></h3></div>
                    <canvas id="analyticsAreaChart" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated ....</div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                <script>
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';
                    let ctx = document.getElementById("analyticsAreaChart");
                    let analyticsLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
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
                                data: [],
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
                                data: [],
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
                                        min: -1000,
                                        max: 1000,
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

                    let elementsClick = document.getElementsByClassName('updateCharts');

                    for (let i = 0; i < elementsClick.length; i++) {
                        elementsClick[i].addEventListener('click', function(){
                            UpdateChart(analyticsLineChart, elementsClick[i].dataset.variant);
                        }, false);
                    }

                    function UpdateChart(chart, variant) {
                        let xmlHttp = new XMLHttpRequest();
                        let start = document.getElementById('start-' + variant).value;
                        let final = document.getElementById('final-' + variant).value;
                        let type = document.getElementById('type-' + variant).value;
                        let v,set;
                        if(variant==='incomes'){
                            v = 1;
                            set = [{
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
                                }]
                        }else{
                            v = 2;
                            set = [{
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
                                }]
                        }

                        xmlHttp.onreadystatechange = function () {
                            if (this.readyState === 4 && this.status === 200) {
                                const response = JSON.parse(this.response);
                                const array = response.date;
                                const data =  {
                                    labels: Object.keys(array),
                                    datasets: [{
                                        label: '',
                                        data: Object.values(array)
                                    }]
                                }

                                const opt = {
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
                                                    min: response.min,
                                                    max: response.max,
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
                                }

                                chart.data.labels = data.labels
                                chart.data.datasets = data.datasets
                                chart.options = opt.options
                                chart.update()
                                document.getElementById('show-amount').innerText = response.amount;
                            }
                        };
                        xmlHttp.open("GET", "/analytics/data?start=" + start + "&final=" + final + "&type=" + type+ "&variant=" + v, true);
                        xmlHttp.send();
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
