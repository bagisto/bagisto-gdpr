<?php 

$gdprRepository = app('Webkul\GDPR\Repositories\GDPRRepository');

$gdpr = $gdprRepository->get();

foreach ($gdpr as $value) {
    $gdprData = $value;
}

?>
@if($gdprData->gdpr_status == 1 && $gdprData->cookie_status == 1)
    @if($gdprData->cookie_block_position == 'bottom-left')
        <div class="cookieConsentContainer js-cookie-consent cookie-consent" id="cookieConsentContainer" style="opacity: 1; display: block; left:10px;">
    @else
        <div class="cookieConsentContainer js-cookie-consent cookie-consent" id="cookieConsentContainer" style="opacity: 1; display: block;">
    @endif
            <div class="cookieTitle">
                <a>Cookies.</a>
            </div>

            <div class="cookieDesc cookie-consent__message">
                <p>By using this website, you automatically accept that we use cookies.</p>
            </div>

            <div class="cookieButton">
                <a class="js-cookie-consent-agree cookie-consent__agree" onclick="createCookie()">Understood</a>
            </div>
        </div>
@endif
