@php $gdpr = app('Webkul\GDPR\Repositories\GDPRRepository')->first(); @endphp

@if($gdpr->gdpr_status == 1 && $gdpr->cookie_status == 1)
    @if($gdpr->cookie_block_position == 'bottom-left')
        <div class="cookieConsentContainer js-cookie-consent cookie-consent" id="cookieConsentContainer" style="opacity: 1; display: block; left:10px;">
    @else
        <div class="cookieConsentContainer js-cookie-consent cookie-consent" id="cookieConsentContainer" style="opacity: 1; display: block;">
    @endif
            <div class="cookieTitle">
                <a>Cookies.</a>
            </div>
            <div class="cookieDesc cookie-consent__message">
                <p>{{ __('gdpr::app.shop.customer.cookie.cookie-description') }}<a href="{{ url()->to('/') .'/page/	privacy-policy' }}"> {{ __('gdpr::app.shop.customer.cookie.privacy-policy') }}</a></p>
            </div>
            <div class="cookieButton">
                <a class="js-cookie-consent-agree cookie-consent__agree" onclick="rejectCookie()">{{ __('gdpr::app.shop.customer.cookie.reject') }}</a>
          
                <a class="js-cookie-consent-agree cookie-consent__agree" onclick="createCookie()">{{ __('gdpr::app.shop.customer.cookie.accept') }}</a>

                <a class="js-cookie-consent-agree cookie-consent__agree" onclick="createCookie()" href="{{ route('gdpr.cookie.index') }}">{{ __('gdpr::app.shop.customer.cookie.learn-more-and-customize') }}</a>
            </div>
        </div>
@endif
