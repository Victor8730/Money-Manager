<div class="my-2"><strong>Oops!</strong> There are problems with this {{$delete}}:</div>
<ul>
    @foreach ($ul as $li)
        <li><a href="/{{$delete}}/{{ $li->id }}/edit/">{{ $li->date }}</a></li>
    @endforeach
</ul>
