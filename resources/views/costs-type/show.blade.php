@extends('layouts.template')


@section('content')

    <h1 class="mt-4">Show type costs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/costs-type/">Type costs</a></li>
        <li class="breadcrumb-item active"> {{ $costsType->name }}</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('costs-type.index') }}" title="Go back">Back <i
                        class="fas fa-backward "></i> </a>
                </a>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $costsType->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $costsType->desc }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 m-2">
                <div class="form-group">
                    <strong>Date Created:</strong>
                    {{ date_format($costsType->created_at, 'jS M Y') }}
                </div>
            </div>
        </div>
    </div>
@endsection
