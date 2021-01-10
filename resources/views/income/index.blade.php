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
                   title="@lang('incomes-costs.create-new-income')">
                    <i class="fas fa-plus-circle mr-2"></i>@lang('incomes-costs.create')
                </a>
                <button class="btn btn-info tooltip-show" title="@lang('incomes-costs.filter-open')" data-toggle="collapse"
                        data-target=".collapseFilter" role="button" aria-expanded="false"
                        aria-controls="collapseFilter"><i class="fas fa-filter mr-2"></i>@lang('incomes-costs.filter')
                </button>
            </div>
        </div>
    </div>

    @include('income.filter')

    @include('errors.session')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            @lang('incomes-costs.income-table')
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>@lang('incomes-costs.type')</th>
                        <th>@lang('incomes-costs.amount')</th>
                        <th>@lang('incomes-costs.date-posted')</th>
                        <th width="150px">@lang('incomes-costs.action')</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>@lang('incomes-costs.type')</th>
                        <th>@lang('incomes-costs.amount')</th>
                        <th>@lang('incomes-costs.date-posted')</th>
                        <th width="150px">@lang('incomes-costs.action')</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($income as $inc)
                        <tr>
                            <td>{{ $incomeType[$inc->type_id]['name'] }}</td>
                            <td>{{ $inc->amount }}</td>
                            <td>{{ date_format(new DateTime($inc->date), 'jS M Y') }}</td>
                            <td>
                                <form action="{{ route('income.destroy', $inc->id) }}" class="del-item" method="POST">

                                    <a href="{{ route('income.show', $inc->id) }}" title="@lang('incomes-costs.show')" class="btn tooltip-show p-1">
                                        <i class="fas fa-eye text-success  fa-lg"></i>
                                    </a>
                                    <a href="{{ route('income.edit', $inc->id) }}" title="@lang('incomes-costs.edit')" class="btn tooltip-show p-1">
                                        <i class="fas fa-edit  fa-lg"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" title="@lang('incomes-costs.delete')" class="btn tooltip-show p-1">
                                        <i class="fas fa-trash fa-lg text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{ $income->links('income.pagination') }}

@endsection

