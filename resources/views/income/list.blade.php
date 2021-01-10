<ul class="list-group">
    @forelse ($incomeData as $income)
        <li class="list-group-item">
            <a href="/income/{{$income->id}}/edit"
               class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white"
               title="{{$income->desc}}">
                {{$income->amount}} - {{$nameType[$income->type_id]}}
            </a>
        </li>
    @empty
        <li class="list-group-item">@lang('incomes-costs.no-income-today')</li>
    @endforelse
</ul>



