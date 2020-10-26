<div
    class="day col-sm p-2 border border-left-0 border-top-0 text-truncate {{ $tempDate->month !== $today->month ? 'd-none d-sm-inline-block bg-light text-muted' : '' }}">
    <h5 class="row align-items-center">
        <span class="date col-1">{{$tempDate->day}}</span>
        <small class="col d-sm-none text-center text-muted">{{$tempDate->format('l')}}</small>
        <span class="col-1"></span>
    </h5>
    <div class="text-center">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" title="Add income" class="btn p-1 tooltip-show add-event"
                    data-date="{{$tempDate->format('Y-m-d')}}"
                    data-toggle="modal"
                    data-target="#add_{{$tempDate->day}}"
                    data-url="/income/create"
                    data-info="Add income">
                <i class="fas fa-plus-circle text-success"></i>
                <span class="d-block">Income</span>
            </button>
            <button type="button" title="Add costs" class="btn p-1 tooltip-show add-event"
                    data-date="{{$tempDate->format('Y-m-d')}}"
                    data-toggle="modal"
                    data-target="#add_{{$tempDate->day}}"
                    data-url="/costs/create"
                    data-info="Add costs">
                <i class="fas fa-plus-circle text-danger"></i>
                <span class="d-block">Cost</span>
            </button>
        </div>
    </div>
    <hr>
    <ul class="list-group my-1 list-scroll">
        @forelse ($incomeData as $income)
            <li><a title=""
                   class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white"
                   href="/income/{{$income->id}}/edit">{{$income->amount}}</a></li>
        @empty
            <li><p class="d-sm-none">No income today</p></li>
        @endforelse

        @forelse ($costsData as $cost)
            <li><a title="{{$cost->desc}}"
                   class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white"
                   href="/costs/{{$cost->id}}/edit">{{$cost->amount}}</a></li>
        @empty
            <li><p class="d-sm-none">No cost today</p></li>
        @endforelse
    </ul>

    @include('layouts.modal', ['day' => $tempDate->day])

</div>
{!! ($nextWeek === 6) ? '<div class="w-100"></div>' : '' !!}
