@extends('layouts.template')

@section('content')


    <h1 class="mt-4">Create new income type</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/income-type/">Type income</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-right">
                <a class="btn btn-primary tooltip-show" href="{{ route('income-type.index') }}" title="Go back">
                   Back <i class="fas fa-backward "></i>
                </a>
            </div>
        </div>
    </div>

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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pencil-alt"></i>
            Fill in the fields to create a new type
        </div>
        <div class="card-body">
            <form action="{{ route('income-type.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Type description:</strong>
                            <textarea class="form-control" style="height:50px" name="desc"
                                      placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success tooltip-show" title="Click this button to create a new type">Create new type</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
