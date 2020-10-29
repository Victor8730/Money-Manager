@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Income</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Income</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-success tooltip-show" href="{{ route('income.create') }}"
                   title="Create new income type">Create <i class="fas fa-plus-circle"></i>
                </a>
                <button class="btn btn-info tooltip-show" title="Open filter" data-toggle="collapse"
                        data-target=".collapseFilter" role="button" aria-expanded="false"
                        aria-controls="collapseFilter">
                    Filter <i class="fas fa-filter"></i>
                </button>
            </div>
        </div>
    </div>

    @include('errors.session')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Income table
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">111111111111</li>
{{--                @foreach ($settings as $set)--}}
{{--                        <td>{{ date_format(new DateTime($inc->date), 'jS M Y') }}</td>--}}
{{--                            <form action="{{ route('income.destroy', $inc->id) }}" class="del-item" method="POST">--}}

{{--                                <a href="{{ route('income.show', $inc->id) }}" title="show" class="btn p-1">--}}
{{--                                    <i class="fas fa-eye text-success  fa-lg"></i>--}}
{{--                                </a>--}}
{{--                                <a href="{{ route('income.edit', $inc->id) }}" class="btn p-1">--}}
{{--                                    <i class="fas fa-edit  fa-lg"></i>--}}
{{--                                </a>--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}

{{--                                <button type="submit" title="delete" class="btn p-1">--}}
{{--                                    <i class="fas fa-trash fa-lg text-danger"></i>--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                @endforeach--}}
            </ul>
        </div>
    </div>

@endsection

