@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Edit cost type</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/costs-type/">Type costs</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-primary tooltip-show" href="{{ route('costs-type.index') }}" title="@lang('incomes-costs.go-back')">
                    <i class="fas fa-backward mr-2"></i>@lang('incomes-costs.back')
                </a>
            </div>
        </div>
    </div>

    @include('errors.fields')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pencil-alt"></i>
            @lang('incomes-costs.change-fields-costs-type')
        </div>
        <div class="card-body">
        <form action="{{ route('costs-type.update', $costsType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>@lang('incomes-costs.name'):</strong>
                        <input type="text" name="name" value="{{ $costsType->name }}" class="form-control"
                               placeholder="@lang('incomes-costs.name')">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>@lang('incomes-costs.type-description'):</strong>
                        <textarea class="form-control" name="desc" placeholder="@lang('incomes-costs.description')">{{ $costsType->desc }}</textarea>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>@lang('incomes-costs.parent'):  <span class="tooltip-show" title="@lang('incomes-costs.settings-parent')"><i class="fas fa-info-circle tooltip-show"></i></span></strong>
                        <div class="checkbox">
                            <label>
                                <select class="form-control" name="parent">
                                    <option value="0" {{($costsType->parent) === 0 ? 'selected' : '' }}>@lang('incomes-costs.empty')</option>
                                    @foreach ($type as $t)
                                        @if ($costsType->id !== $t->id)
                                            <option value="{{ $t->id }}" {{($costsType->parent) === $t->id ? 'selected' : '' }}>{{$t->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>@lang('incomes-costs.status'):  <span class="tooltip-show" title="@lang('incomes-costs.settings-fields-hide')"><i class="fas fa-info-circle tooltip-show"></i></span></strong>
                        <div class="checkbox">
                            <label>
                                <select class="form-control" name="status">
                                    <option value="1" {{($costsType->status) === 1 ? 'selected' : '' }}>@lang('incomes-costs.on')</option>
                                    <option value="0" {{($costsType->status) === 0 ? 'selected' : '' }}>@lang('incomes-costs.off')</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success tooltip-show" title="@lang('incomes-costs.click-this-button-to-update-type')">
                    @lang('incomes-costs.update-type')
                </button>
            </div>
        </form>
        </div>
        </div>
@endsection
