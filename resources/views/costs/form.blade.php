@include('errors.fields')

<form action="{{ isset($typeForm) ? route('costs.update', $cost->id) : route('costs.store') }}" method="POST">

    @csrf
    @if (isset($typeForm))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Amount:</strong>
                <input type="text" name="amount" class="form-control" placeholder="amount"
                       value="{{ isset($typeForm) ? $cost->amount  : null }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type costs:</strong>
                <div class="input-group">
                    <select class="form-control" name="type_id">
                        @foreach($costsType as $type)
                            <option
                                value="{{ $type->id }}" {{ isset($typeForm) ? (($type->id == $cost->type_id) ? 'selected' : null) : null}}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <a href="/costs-type/create" class="btn input-group-text" target="_blank">New type</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="desc">{{ isset($typeForm) ? $cost->desc  : null }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                <input type="date" class="form-control datepicker" name="date"
                       value="{{ isset($typeForm) ? date_format(new DateTime($cost->date), 'Y-m-d')  : null }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success tooltip-show" title="Click this button to create a new costs">
                {{ isset($typeForm) ? 'Update cost' :  'Create new cost' }}
            </button>
        </div>
    </div>
</form>
