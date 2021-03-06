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
                <a class="btn btn-primary tooltip-show" href="{{ route('income.index') }}" title="@lang('incomes-costs.go-back')">
                    <i class="fas fa-backward mr-2"></i>@lang('incomes-costs.back')
                </a>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pencil-alt mr-2"></i>
            @lang('incomes-costs.fill-all-fields-income')
        </div>
        <div class="card-body">
            @include('income.form')
        </div>
    </div>
@endsection
