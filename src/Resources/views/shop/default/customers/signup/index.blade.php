@extends('shop::layouts.master')
@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection
@section('content-wrapper')

<div class="auth-content">

    <div class="sign-up-text">
        {{ __('shop::app.customer.signup-text.account_exists') }} - <a href="{{ route('customer.session.index') }}">{{ __('shop::app.customer.signup-text.title') }}</a>
    </div>

    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

    <form method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">

        {{ csrf_field() }}

        <div class="login-form">
            <div class="login-text">{{ __('shop::app.customer.signup-form.title') }}</div>

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

            <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                <label for="first_name" class="required">{{ __('shop::app.customer.signup-form.firstname') }}</label>
                <input type="text" class="control" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}

            <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                <label for="last_name" class="required">{{ __('shop::app.customer.signup-form.lastname') }}</label>
                <input type="text" class="control" name="last_name" v-validate="'required'" value="{{ old('last_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}

            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                <label for="email" class="required">{{ __('shop::app.customer.signup-form.email') }}</label>
                <input type="email" class="control" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.email.after') !!}

            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                <label for="password" class="required">{{ __('shop::app.customer.signup-form.password') }}</label>
                <input type="password" class="control" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;">
                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.password.after') !!}

            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                <label for="password_confirmation" class="required">{{ __('shop::app.customer.signup-form.confirm_pass') }}</label>
                <input type="password" class="control" name="password_confirmation"  v-validate="'required|min:6|confirmed:password'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;">
                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.password_confirmation.after') !!}
            
            @php
                $gdpr = app('Webkul\GDPR\Repositories\GDPRRepository')->first();   
            @endphp
                        
            @if($gdpr->gdpr_status == 1 && $gdpr->customer_agreement_status == 1)
                        
                <div class="control-group" :class="[errors.has('agreement') ? 'has-error' : '']">
                    <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.agreement') }}&quot;">
                    <label class="required">
                        <a href="#" @click="myFunction">{{ $gdpr->agreement_label }}</a>
                    </label>
                    <span class="control-error" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
                </div>

                <!-- Modal -->
                <modal-view></modal-view>

            @endif

            {{-- <div class="signup-confirm" :class="[errors.has('agreement') ? 'has-error' : '']">
                <span class="checkbox">
                    <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'">
                    <label class="checkbox-view" for="checkbox2"></label>
                    <span>{{ __('shop::app.customer.signup-form.agree') }}
                        <a href="">{{ __('shop::app.customer.signup-form.terms') }}</a> & <a href="">{{ __('shop::app.customer.signup-form.conditions') }}</a> {{ __('shop::app.customer.signup-form.using') }}.
                    </span>
                </span>
                <span class="control-error" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
            </div> --}}

            {{-- <span class="checkbox">
                <input type="checkbox" id="checkbox1" name="checkbox[]">
                <label class="checkbox-view" for="checkbox1"></label>
                Checkbox Value 1
            </span> --}}

            <div class="control-group">

                {!! Captcha::render() !!}

            </div>

            @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                <div class="control-group">
                    <input type="checkbox" id="checkbox2" name="is_subscribed">
                    <span>{{ __('shop::app.customer.signup-form.subscribe-to-newsletter') }}</span>
                </div>
            @endif

            {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

            <button class="btn btn-primary btn-lg" type="submit">
                {{ __('shop::app.customer.signup-form.button_title') }}
            </button>

        </div>
    </form>

    {!! view_render_event('bagisto.shop.customers.signup.after') !!}
</div>
@endsection

@push('scripts')

{!! Captcha::renderJS() !!}

@endpush


@push('scripts')

<script type="text/x-template" id="modalView">
    <template>
        <div class="modal-parent scrollable" style="display:none" id="modal_view">
            <div class="modal-container">
                <div id="close-button">
                        <button id="x" class="modal-btn" @click="closeModal">X</button>
                </div>
                <div class="modal-header">
                    <slot name="header">
                        Terms & Conditions
                    </slot>
                </div>
                <div class="modal-body">
                    <slot name="body">
                        @php
                            try {
                                    if($gdpr && $gdpr->customer_agreement_status == 1) {
                        @endphp
                                        {!! $gdpr->agreement_content !!}
                        @php
                                    }
                                } catch(\Exception $e) {}
                        @endphp
                    </slot>
                </div>
            </div>
        </div>
    </template>
</script>

<script type="text/javascript">
    (() => {
        Vue.component('modal-view', {
            'template': '#modalView',
            props: ['id', 'isOpen'],
            data: function () {
                return {
                }
            },
            computed: {
                isModalOpen: function () {
                this.addClassToBody();
                return this.isOpen;
                }
            },
            methods: {
                    addClassToBody: function () {
                    var body = document.querySelector("body");
                        if(this.isOpen) {
                            body.classList.add("modal-open");
                        } else {
                            body.classList.remove("modal-open");
                        }
                    }
            }
        })
    })()
</script>

<script>

    function closeModal() {

        document.getElementById("modal_view").style.display = "none";
    }

    function myFunction() {

        var x = document.getElementById("modal_view");
        
        if (x.style.display === "none") {
            x.style.display = "block";
        }
    }

</script>

@endpush