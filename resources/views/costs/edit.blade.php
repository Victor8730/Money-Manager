@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Edit cost</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/costs/">Costs</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-primary tooltip-show" href="javascript:history.go(-1)" title="Go back">
                    <i class="fas fa-angle-left mr-2"></i> Back
                </a>
                <a class="btn btn-primary tooltip-show" href="{{ route('costs.index') }}" title="Go back to list">
                    <i class="fas fa-angle-double-left mr-2"></i> Costs
                </a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
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
            Change fields for costs
        </div>
        <div class="card-body">
        <form action="{{ route('costs.update', $cost->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Amount:</strong>
                        <input type="text" name="amount" value="{{ $cost->amount }}" class="form-control"
                               placeholder="amount">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Type costs:</strong>
                        <select class="form-control" name="type">
                            @foreach($costsType as $type)
                                <option value="{{ $type->id }}" {{($type->id == $cost->type) ? 'selected' : null}}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" name="desc" id="desc">{{$cost->desc}}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date:</strong>
                        <input type="date" class="form-control datepicker" name="date" id="date" value="{{date_format(new DateTime($cost->date), 'Y-m-d')}}">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success tooltip-show" title="Click this button to update cost">Update cost</button>
            </div>
        </form>
        </div>
        </div>
@endsection
