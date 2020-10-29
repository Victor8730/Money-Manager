<div class="col-lg-12 my-2 collapse collapseFilter {{ request()->get('type') ? 'show' : null }}">
    <div class="card">
        <h5 class="card-header">Filter</h5>
        <div class="card-body">
            <form action="{{ route('income.index') }}" class="filter-apply" method="GET">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Select type</span>
                    </div>
                    <select class="form-control" name="type">
                        <option value="">...</option>
                        @foreach ($incomeType as $type)
                            <option value="{{ $type['id'] }}" {{ request()->get('type')==$type['id'] ? 'selected' : null }}> {{ $type['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Select date</span>
                    </div>
                    <input type="date" class="form-control" name="date">
                </div>
                <button class="btn btn-success" type="submit">Apply filter</button>
                <a href="{{ route('income.index') }}" class="btn btn-secondary">Clear filter</a>
            </form>
        </div>
    </div>
</div>
