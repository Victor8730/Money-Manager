<ul class="list-group">
    @forelse ($costsData as $cost)
        <li class="list-group-item">
            <a href="/costs/{{$cost->id}}/edit"
               class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white"
               title="{{$cost->desc}}">
                {{$cost->amount}} - {{$nameType[$cost->type_id]}}</a>
        </li>
    @empty
        <li class="list-group-item">@lang('incomes-costs.no-costs-today')</li>
    @endforelse
</ul>



