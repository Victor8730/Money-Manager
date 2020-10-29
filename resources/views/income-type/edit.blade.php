@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Edit income type</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/income-type/">Type income</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-primary tooltip-show" href="{{ route('income-type.index') }}" title="Go back">
                    <i class="fas fa-angle-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </div>


    @include('errors.fields')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-pencil-alt"></i>
            Change fields for income type
        </div>
        <div class="card-body">
            <form action="{{ route('income-type.update', $incomeType->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" value="{{ $incomeType->name }}" class="form-control"
                                   placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control" name="desc" placeholder="Description">{{ $incomeType->desc }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-success tooltip-show" title="Click this button to update">
                        Update type
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
