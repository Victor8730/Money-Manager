@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Show costs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/costs/">Costs</a></li>
        <li class="breadcrumb-item active"> {{ $cost->id }}</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('costs.index') }}" title="@lang('incomes-costs.go-back')">
                    <i class="fas fa-backward mr-2"></i>@lang('incomes-costs.back')</a>
                </a>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>@lang('incomes-costs.type'):</strong>
                    {{ $costsType[$cost->type_id]['name'] }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>@lang('incomes-costs.amount'):</strong>
                    {{ $cost->amount }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>@lang('incomes-costs.description'):</strong>
                    {{ $cost->desc }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>@lang('incomes-costs.date-posted'):</strong>
                    {{ date_format(new DateTime($cost->date), 'jS M Y') }}
                </div>
            </div>
        </div>
    </div>
@endsection
