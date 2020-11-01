@extends('layouts.template')

@section('content')

    <div class="py-12">
        @include('errors.session')
        <div class="card mb-2">
            <h4 class="card-header">
                <i class="fas fa-cogs mr-1"></i>
                Settings
            </h4>
            <div class="card-body">
                <form action="{{ route('settings.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <ul class="list-group">
                            @foreach ($settings as $key=>$setting)
                                <li class="list-group-item">
                                    @if(is_array($setting))
                                        <label for="{{$key}}-{{$setting['key']}}" class="h5">
                                            {{ucfirst($setting['name'])}}
                                        </label>
                                        <div>
                                            <select class="form-control" id="{{$key}}-{{$setting['key']}}" name="{{$setting['key']}}">
                                                @foreach($setting['data'] as $id=>$val)
                                                    <option value="{{$id}}">{{$val}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="btn btn-success" type="submit">Save settings</button>
                </form>
            </div>
        </div>
    </div>

@endsection

