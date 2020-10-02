@extends('layouts.template')

@section('content')

    <h1 class="mt-4">Type income</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Type income</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 my-2">
            <div class="pull-left">
                <a class="btn btn-success tooltip-show" href="{{ route('income-type.create') }}" title="Create new income type">Create <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Income type table
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th width="150px">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th width="150px">Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($incomeType as $type)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->desc }}</td>
                            <td>
                                <form action="{{ route('income-type.destroy', $type->id) }}" class="del-item" method="POST">

                                    <a href="{{ route('income-type.show', $type->id) }}" title="show" class="btn p-1">
                                        <i class="fas fa-eye text-success  fa-lg"></i>
                                    </a>
                                    <a href="{{ route('income-type.edit', $type->id) }}" class="btn p-1">
                                        <i class="fas fa-edit  fa-lg"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" title="delete" class="btn p-1">
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


    {{ $incomeType->links('income-type.pagination') }}

@endsection

