@component('shop::emails.layouts.master')
<div style="text-align: center;">
    <a href="{{ config('app.url') }}">
        <img src="{{ bagisto_asset('images/logo.svg') }}">
    </a>
</div>


<div style="padding: 30px;">
    <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
        <span style="font-weight: bold;">
            {{ __('rma::app.mail.customer-conversation.heading',['name' => $conversation['adminName']]) }}
        </span> <br>
        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('rma::app.mail.customer-conversation.quotes') }}
        </p>
    </div>

    <div style="display: flex;flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 20px;">
        <div style="line-height: 25px;">
            <div style="font-weight: bold;font-size: 16px;color: #242424;">
                Message
            </div>

            <div>
                {{ $conversation['message'] }}
            </div>
        </div>
    </div>

    <div
        style="margin-top: 40px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: block; width: 100%; float: left">

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {!! __('shop::app.mail.order.help', [
            'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.from.address') . '">' .
                config('mail.from.address'). '</a>'
            ])
            !!}
        </p>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            {{ __('rma::app.mail.customer-rma-create.thank-you') }}
        </p>
    </div>

</div>

@endcomponent
