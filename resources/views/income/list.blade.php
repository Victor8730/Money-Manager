<ul class="list-group">
    @forelse ($incomeData as $income)
        <li class="list-group-item"><a title="{{$income->desc}}"
                                       class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-success text-white"
                                       href="/income/{{$income->id}}/edit">{{$income->amount}}</a>
        </li>
    @empty
        <li class="list-group-item">No income today</li>
    @endforelse
</ul>



