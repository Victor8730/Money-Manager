@extends('layouts.template')

@section('content')
    <h1 class="mt-4">Create new income</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/income">Income</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-right">
                <a class="btn btn-primary tooltip-show" href="{{ route('income.index') }}" title="Go back">
                    Back <i class="fas fa-backward "></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pencil-alt"></i>
            Fill in the fields to create a new income
        </div>
        <div class="card-body">
            @include('income.form')
        </div>
    </div>
@endsection
