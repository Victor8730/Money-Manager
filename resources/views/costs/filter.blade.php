<div class="col-lg-12 my-2 collapse collapseFilter {{ request()->get('type_id') ? 'show' : null }}">
    <div class="card">
        <h5 class="card-header">@lang('incomes-costs.filter')</h5>
        <div class="card-body">
            <form action="{{ route('costs.index') }}" class="filter-apply" method="GET">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">@lang('incomes-costs.select-type')</span>
                    </div>
                    <select class="form-control" name="type_id">
                        <option value="">...</option>
                        @foreach ($costsType as $type)
                            <option value="{{ $type['id'] }}" {{ request()->get('type_id')==$type['id'] ? 'selected' : null }}> {{ $type['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">@lang('incomes-costs.select-date')</span>
                    </div>
                    <input type="date" class="form-control" name="date">
                </div>
                <button class="btn btn-success" type="submit">@lang('incomes-costs.filter-apply')</button>
                <a href="{{ route('costs.index') }}" class="btn btn-secondary">@lang('incomes-costs.filter-clear')</a>
            </form>
        </div>
    </div>
</div>
