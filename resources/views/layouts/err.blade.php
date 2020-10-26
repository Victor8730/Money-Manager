@if ($errors->any())
    <div class="alert alert-danger m-2">
        <div class="my-2"><strong>Oops!</strong> There are problems with input fields.</div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
