@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Type costs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Type costs</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-success tooltip-show" href="{{ route('costs-type.create') }}" title="@lang('incomes-costs.create-new-costs-type')">
                    <i class="fas fa-plus-circle mr-2"></i>@lang('incomes-costs.create')
                </a>
            </div>
        </div>
    </div>

    @include('errors.session')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            @lang('incomes-costs.costs-type-table')
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>@lang('incomes-costs.no')</th>
                        <th>@lang('incomes-costs.name')</th>
                        <th>@lang('incomes-costs.description')</th>
                        <th width="150px">@lang('incomes-costs.action')</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>@lang('incomes-costs.no')</th>
                        <th>@lang('incomes-costs.name')</th>
                        <th>@lang('incomes-costs.description')</th>
                        <th width="150px">@lang('incomes-costs.action')</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($costsType as $type)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->desc }}</td>
                            <td>
                                <form action="{{ route('costs-type.destroy', $type->id) }}" class="del-item" method="POST">

                                    <a href="{{ route('costs-type.show', $type->id) }}" title="@lang('incomes-costs.show')" class="btn tooltip-show p-1">
                                        <i class="fas fa-eye text-success  fa-lg"></i>
                                    </a>
                                    <a href="{{ route('costs-type.edit', $type->id) }}" title="@lang('incomes-costs.edit')" class="btn tooltip-show p-1">
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


    {{ $costsType->links('costs-type.pagination') }}

@endsection

