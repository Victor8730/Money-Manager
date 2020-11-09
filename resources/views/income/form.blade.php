@include('errors.fields')

<form action="{{ isset($typeForm) ? route('income.update', $income->id) : route('income.store') }}" method="POST">

    @csrf
    @if (isset($typeForm))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Amount:</strong>
                <input type="text" name="amount" class="form-control" placeholder="amount"
                       value="{{ isset($typeForm) ? $income->amount  : null }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type income:</strong>
                <div class="input-group">
                    <select class="form-control" name="type_id">
                        @foreach($incomeType as $type)
                            <option
                                value="{{ $type->id }}" {{ isset($typeForm) ? (($type->id == $income->type_id) ? 'selected' : null) : null}}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <a href="/income-type/create" class="btn input-group-text" target="_blank">New type</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="desc">{{ isset($typeForm) ? $income->desc  : null }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                <input type="date" class="form-control datepicker" name="date"
                       value="{{ isset($typeForm) ? date_format(new DateTime($income->date), 'Y-m-d')  : null }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success">
                {{ isset($typeForm) ? 'Update income' :  'Create new income' }}
            </button>
        </div>
    </div>
</form>
