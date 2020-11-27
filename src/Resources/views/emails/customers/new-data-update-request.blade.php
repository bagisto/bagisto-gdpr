@component('shop::emails.layouts.master')

<div style="text-align: center;">
    <a href="{{ config('app.url') }}">
        <img src="{{ bagisto_asset('images/logo.svg') }}">
    </a>
</div>


<div style="padding: 30px;">
    <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
        <span style="font-weight: bold;">
            {{ __('gdpr::app.mail.new-data-request.heading') }} !
        </span> <br>

        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            {{ __('gdpr::app.mail.new-data-request.summary') }}
        </div>
    </div>


    <div style="flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 20px;">
        <div>
        
            <div style="font-weight: bold;font-size: 16px;color: #242424">
                {{ __('gdpr::app.mail.new-data-request.request-status') }}
            </div>

            <div>
                {{ $dataUpdateRequest['request_status'] }}
            </div>
        </div>

        <div>
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('gdpr::app.mail.new-data-request.request-type') }}
            </div>
            <div>
                {{ $dataUpdateRequest['request_type'] }}
            </div>

            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                {{ __('gdpr::app.mail.new-data-request.message') }}
            </div>

            <div style="font-size: 16px; color: #242424;">
                {{ $dataUpdateRequest['message'] }}
            </div>

        </div>
    </div>

    <div
        style="margin-top: 40px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: block; width: 100%; float: left">

       

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('gdpr::app.mail.new-data-request.thank-you') }}
        </p>
    </div>

</div>

@endcomponent