 <div class="container-fluid py-2">
        <div class="row d-none d-sm-flex p-1 bg-dark text-white">
            <h5 class="col-sm p-1 text-center">@lang('dashboard.sunday')</h5>
            <h5 class="col-sm p-1 text-center">@lang('dashboard.monday')</h5>
            <h5 class="col-sm p-1 text-center">@lang('dashboard.tuesday')</h5>
            <h5 class="col-sm p-1 text-center">@lang('dashboard.wednesday')</h5>
            <h5 class="col-sm p-1 text-center">@lang('dashboard.thursday')</h5>
            <h5 class="col-sm p-1 text-center">@lang('dashboard.friday')</h5>
            <h5 class="col-sm p-1 text-center">@lang('dashboard.saturday')</h5>
        </div>
        <div class="row border border-right-0 border-bottom-0">
        {!! $days !!}
        </div>
 </div>

