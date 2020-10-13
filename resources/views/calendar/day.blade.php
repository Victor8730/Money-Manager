<div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate {{ $tempDate->month !== $today->month ? 'd-none d-sm-inline-block bg-light text-muted' : '' }}">
    <h5 class="row align-items-center">
        <span class="date col-1">{{$tempDate->day}}</span>
        <small class="col d-sm-none text-center text-muted">{{$tempDate->format('l')}}</small>
        <span class="col-1"></span>
    </h5>
    @foreach ($incomeData as $income)
        <a title=""
           class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white"
           href="/income/{{$income->id}}/edit">{{$income->amount}}</a>
    @endforeach
    @foreach ($costsData as $cost)
        <a title="{{$cost->desc}}"
           class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white"
           href="/costs/{{$cost->id}}/edit">{{$cost->amount}}</a>
    @endforeach
    <p class="d-sm-none">No events</p>
</div>
{!! ($nextWeek === 6) ? '<div class="w-100"></div>' : '' !!}
