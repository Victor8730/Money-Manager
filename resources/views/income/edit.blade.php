@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Edit income</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/income/">Income</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-primary tooltip-show" href="javascript:history.go(-1)" title="@lang('incomes-costs.go-back')">
                    <i class="fas fa-angle-left mr-2"></i>@lang('incomes-costs.back')
                </a>
                <a class="btn btn-primary tooltip-show" href="{{ route('income.index') }}" title="@lang('incomes-costs.go-back-list')">
                    <i class="fas fa-angle-double-left mr-2"></i>@lang('incomes-costs.income')
                </a>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pencil-alt"></i>
            @lang('incomes-costs.change-fields-income')
        </div>
        <div class="card-body">
            @include('income.form', ['typeForm' => 'update'])
        </div>
    </div>
@endsection
