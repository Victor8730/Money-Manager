<div
    class="container day col-sm p-2 border border-left-0 border-top-0 text-truncate {{ $tempDate->month !== $today->month ? 'd-none d-sm-inline-block bg-light text-muted' : '' }}"
    id="day-{{$tempDate->format('Y-m-d')}}">
    <h5 class="row align-items-center">
        <span class="date badge badge-dark">{{$tempDate->day}}</span>
        <small class="col d-sm-none text-center text-muted">{{$tempDate->format('l')}}</small>
        <span class="col-1"></span>
    </h5>
    <div class="row">
        <div class="text-center col-md-12 col-lg-12">
            <span class="d-block text-success">@lang('dashboard.income')</span>
            <span class="d-block text-success">+{{(isset($settings['format']['value']) === 1) ? number_format($amountsIncomeByDay) : number_format($amountsIncomeByDay, 2, ',', ' ')}} {{$settings['currency']['value-text']??''}}</span>
            <div class="btn-group" role="group" aria-label="Income area">
                <button type="button" class="btn btn-outline-secondary p-1 tooltip-show event-add" title="@lang('dashboard.add-income')"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->month}}{{$tempDate->day}}"
                        data-url="/income/create"
                        data-info="@lang('dashboard.add-income')">
                    <i class="fas fa-plus-circle text-success"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary tooltip-show event-list" title="@lang('dashboard.show-list-incomes')"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->month}}{{$tempDate->day}}"
                        data-url="/income/list"
                        data-info="@lang('dashboard.show-list-incomes')">
                    <i class="fas fa-list"></i>
                </button>
                <a href="{{route('income.index',['date'=>$tempDate->format('Y-m-d')])}}"
                   class="btn btn-outline-secondary tooltip-show" title="@lang('dashboard.show-list-incomes-for-editing')" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="text-center col-md-12 col-lg-12">
            <span class="d-block text-danger">@lang('dashboard.costs')</span>
            <span class="d-block text-danger">-{{(isset($settings['format']['value']) === 1) ? number_format($amountsCostsByDay) : number_format($amountsCostsByDay, 2, ',', ' ')}} {{$settings['currency']['value-text']??''}}</span>
            <div class="btn-group" role="group" aria-label="Costs area">
                <button type="button" class="btn btn-outline-secondary p-1 tooltip-show event-add" title="@lang('dashboard.add-costs')"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->month}}{{$tempDate->day}}"
                        data-url="/costs/create"
                        data-info="@lang('dashboard.add-costs')">
                    <i class="fas fa-plus-circle text-danger"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary tooltip-show event-list" title="@lang('dashboard.show-list-costs')"
                        data-date="{{$tempDate->format('Y-m-d')}}"
                        data-toggle="modal"
                        data-target="#add_{{$tempDate->month}}{{$tempDate->day}}"
                        data-url="/costs/list"
                        data-info="@lang('dashboard.show-list-costs')">
                    <i class="fas fa-list"></i>
                </button>
                <a href="{{route('costs.index',['date'=>$tempDate->format('Y-m-d')])}}"
                   class="btn btn-outline-secondary tooltip-show" title="@lang('dashboard.show-list-costs-for-editing')" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </div>

    @include('layouts.modal', ['day' => $tempDate->month.$tempDate->day])

</div>
{!! ($nextWeek === 6) ? '<div class="w-100"></div>' : '' !!}
