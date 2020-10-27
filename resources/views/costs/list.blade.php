<ul class="list-group">
    @forelse ($costsData as $cost)
        <li class="list-group-item"><a title="{{$cost->desc}}"
                                       class="tooltip-show d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small bg-danger text-white"
                                       href="/costs/{{$cost->id}}/edit">{{$cost->amount}}</a>
        </li>
    @empty
        <li class="list-group-item">No cost today</li>
    @endforelse
</ul>



