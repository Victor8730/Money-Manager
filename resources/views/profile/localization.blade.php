@if($success === 1)
    <div class="alert alert-success">
        <h3>@lang('localization.language')</h3>
        <p>@lang('localization.localization-changed')</p>
        <button type="button" class="btn btn-success tooltip-show"
                onclick="location.reload();"
                title="@lang('localization.refresh-title')">
            @lang('localization.refresh')
        </button>
    </div>
@endif

@if($success === 0)
    <div class="alert alert-danger">
        <p>@lang('localization.localization-not-changed')</p>
    </div>
@endif

