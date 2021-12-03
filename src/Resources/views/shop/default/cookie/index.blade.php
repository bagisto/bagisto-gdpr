@extends('shop::layouts.master')

@section('page_title')
    {{ __('gdpr::app.shop.customer.cookie.your-cookie-consent-preferences') }}
@endsection

@section('content-wrapper')

    <div class="cms-page-container cart-details row">
        <div class="account-layout">
            <div class="account-head mb-10">
                <span class="account-heading">
                    {{ __('gdpr::app.shop.customer.cookie.your-cookie-consent-preferences') }}
                </span>
                <div class="account-action">
                    <button type="submit" class="btn btn-lg btn-primary mt-10" style="margin-bottom:10px;" onclick="getCustomizeCookie();">
                        {{ __('gdpr::app.shop.customer.cookie.save-and-continue') }}
                    </button>
                </div>
            </div>

            @php
                $gdpr = app('Webkul\GDPR\Repositories\GDPRRepository')->first();   
            @endphp

            <div class="account-table-content">
                <accordian :active="true">
                    <div slot="header">
                        {{ __('gdpr::app.shop.customer.cookie.strictly-necessary') }}
                    </div>

                    <div slot="body">
                        <div class="control-group boolean">
                            <label for="strictly_necessary_cookie">
                                {{ $gdpr->strictly_necessary_cookie }}
                            </label> 
                            <label class="switch">
                                <input type="checkbox" id="strictly_necessary_cookie" name="strictly_necessary_cookie" checked="checked" disabled="disabled" class="control">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </accordian>

                <accordian :active="true">
                    <div slot="header">
                        {{ __('gdpr::app.shop.customer.cookie.basic-interactions-and-functionalities') }}
                    </div>

                    <div slot="body">
                        <div class="control-group boolean">
                            <label for="basic_interactions_and_functionalities_cookie">
                                {{ $gdpr->basic_interactions_and_functionalities_cookie }}
                            </label> 
                            <label class="switch">
                                <input type="checkbox" id="basic_interactions_and_functionalities_cookie" name="basic_interactions_and_functionalities_cookie" class="basic_interactions_and_functionalities_cookie control">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </accordian>

                <accordian :active="true">
                    <div slot="header">
                        {{ __('gdpr::app.shop.customer.cookie.experience-enhancement') }}
                    </div>

                    <div slot="body">
                        <div class="control-group boolean">
                            <label for="experience_enhancement_cookie">
                                {{ $gdpr->experience_enhancement_cookie }}
                            </label> 
                            <label class="switch">
                                <input type="checkbox" id="experience_enhancement_cookie" name="experience_enhancement_cookie" class="control">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </accordian>

                <accordian :active="true">
                    <div slot="header">
                        {{ __('gdpr::app.shop.customer.cookie.measurement') }}
                    </div>

                    <div slot="body">
                        <div class="control-group boolean">
                            <label for="measurement_cookie">
                                {{ $gdpr->measurement_cookie }}
                            </label> 
                            <label class="switch">
                                <input type="checkbox" id="measurement_cookie" name="measurement_cookie" class="control">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </accordian>

                <accordian :active="true">
                    <div slot="header">
                        {{ __('gdpr::app.shop.customer.cookie.targeting-and-advertising') }}
                    </div>

                    <div slot="body">
                        <div class="control-group boolean">
                            <label for="targeting_and_advertising_cookie">
                                {{ $gdpr->targeting_and_advertising_cookie }}
                            </label> 
                            <label class="switch">
                                <input type="checkbox" id="targeting_and_advertising_cookie" name="targeting_and_advertising_cookie" class="control">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </accordian>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>   

        function getCustomizeCookie()
        {
            
            var strictly_necessary =  $("#strictly_necessary_cookie").prop("checked");
            var basic_interactions_and_functionalities = $("#basic_interactions_and_functionalities_cookie").prop("checked");
            var experience_enhancement = $("#experience_enhancement_cookie").prop("checked");
            var measurement = $("#measurement_cookie").prop("checked");
            var targeting_and_advertising = $("#targeting_and_advertising_cookie").prop("checked");
            
            window.location = '{{ url('/') }}';
        }

    </script>
@endpush