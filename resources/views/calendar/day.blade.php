<div
    class="container day col-sm p-2 border border-left-0 border-top-0 text-truncate {{ $tempDate->month !== $today->month ? 'd-none d-sm-inline-block bg-light text-muted' : '' }}">
    <h5 class="row align-items-center">
        <span class="date col-1">{{$tempDate->day}}</span>
        <small class="col d-sm-none text-center text-muted">{{$tempDate->format('l')}}</small>
        <span class="col-1"></span>
    </h5>
    <hr>
    <div class="row">
        <div class="text-center col-md-12 col-lg-12">
            <span class="d-block text-success">Income</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" title="Add income" class="btn btn-outline-secondary p-1 tooltip-show event-add"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->day}}"
                        data-url="/income/create"
                        data-info="Add income">
                    <i class="fas fa-plus-circle text-success"></i>
                </button>
                <button class="btn btn-outline-secondary tooltip-show event-list" title="Show List incomes"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->day}}"
                        data-url="/income/list"
                        data-info="Show list income">
                    <i class="fas fa-list"></i>
                </button>
                <a href="{{route('income.index',['date'=>$tempDate->format('Y-m-d')])}}"
                   class="btn btn-outline-secondary tooltip-show" title="Show List for editing" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="text-center col-md-12 col-lg-12">
            <span class="d-block text-danger">Costs</span>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" title="Add costs" class="btn btn-outline-secondary p-1 tooltip-show event-add"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->day}}"
                        data-url="/costs/create"
                        data-info="Add costs">
                    <i class="fas fa-plus-circle text-danger"></i>
                </button>
                <button class="btn btn-outline-secondary tooltip-show event-list" title="Show List costs"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->day}}"
                        data-url="/costs/list"
                        data-info="Show list costs">
                    <i class="fas fa-list"></i>
                </button>
                <a href="{{route('costs.index',['date'=>$tempDate->format('Y-m-d')])}}"
                   class="btn btn-outline-secondary tooltip-show" title="Show List for editing" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </div>
    <hr>

    @include('layouts.modal', ['day' => $tempDate->day])

</div>
{!! ($nextWeek === 6) ? '<div class="w-100"></div>' : '' !!}
