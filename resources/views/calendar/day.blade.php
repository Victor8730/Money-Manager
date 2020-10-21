<div
    class="day col-sm p-2 border border-left-0 border-top-0 text-truncate {{ $tempDate->month !== $today->month ? 'd-none d-sm-inline-block bg-light text-muted' : '' }}">
    <h5 class="row align-items-center">
        <span class="date col-1">{{$tempDate->day}}</span>
        <small class="col d-sm-none text-center text-muted">{{$tempDate->format('l')}}</small>
        <span class="col-1"></span>
    </h5>
    @forelse ($incomeData as $income)
        <a title=""
           class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white"
           href="/income/{{$income->id}}/edit">{{$income->amount}}</a>
    @empty
        <p class="d-sm-none">No income today</p>
    @endforelse

    @forelse ($costsData as $cost)
        <a title="{{$cost->desc}}"
           class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white"
           href="/costs/{{$cost->id}}/edit">{{$cost->amount}}</a>
    @empty
        <p class="d-sm-none">No cost today</p>
    @endforelse

    <div class="text-center">
        <button type="button" title="Add" class="btn btn-xs btn-default btn-flat tooltip-show income-add"
                data-day="{{$tempDate->day}}"
                data-month="{{$tempDate->month}}"
                data-toggle="modal"
                data-target="#addIncome{{$tempDate->day}}"
                data-url="/income/create">
            <i class="fas fa-plus-square"></i>
        </button>
    </div>

    @include('layouts.modal', ['day' => $tempDate->day, 'month'=>$tempDate->month])


    {{--    <div id="addIncome{{$tempDate->day}}" class="event modal fade">--}}
    {{--        <div class="modal-dialog" role="document">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-body">--}}
    {{--                    <p>Are you sure you want to delete <span class="pName"></span>?</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <a href="{{ route('costs.create') }}" data-remote="true"> <i class="fas fa-plus-square"></i>add </a>--}}
</div>
{!! ($nextWeek === 6) ? '<div class="w-100"></div>' : '' !!}
