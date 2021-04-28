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

            <div class="list-group">
                @foreach ($costsType as $type)

                    <div class="list-group-item">
                        <div class="h5 pr-5">
                            <a href="{{ route('costs-type.edit', $type->id) }}" class="text-secondary">
                                {{ $type->name }}
                            </a>
                        </div>

                        {!!$type->parent !== 0 ? '<span class="btn p1 badge-secondary badge tooltip-show" title="'.__('incomes-costs.parent-exist').'"><i class="fas fa-angle-double-right"></i></span>' : ''!!}
                        {!!$type->status === 1 ? '<span class="btn p1 tooltip-show" title="'.__('incomes-costs.status-on').'"><i class="fa fa-check text-success"></i></span>' : '<span class="btn p1 tooltip-show" title="'.__('incomes-costs.status-off').'"><i class="fas fa-minus"></i></span>'!!}

                        <form action="{{ route('costs-type.destroy', $type->id) }}" class="del-item figure" method="POST">

                            <a href="{{ route('costs-type.show', $type->id) }}" title="{{ $type->desc }}" class="btn tooltip-show p-1">
                                <i class="fas fa-eye text-success fa-lg"></i>
                            </a>
                            <a href="{{ route('costs-type.edit', $type->id) }}" title="@lang('incomes-costs.edit')" class="btn tooltip-show p-1">
                                <i class="fas fa-edit fa-lg text-secondary"></i>
                            </a>
                            @csrf
                            @method('DELETE')

                            <button type="submit" title="@lang('incomes-costs.delete')" class="btn tooltip-show p-1">
                                <i class="fas fa-trash fa-lg text-danger"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{ $costsType->links('costs-type.pagination') }}

@endsection

