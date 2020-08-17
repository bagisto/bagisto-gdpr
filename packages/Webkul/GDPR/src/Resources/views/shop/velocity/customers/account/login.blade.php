@extends('shop::layouts.master')

@section('page_title')
    {{ __('rma::app.shop.guest-users.title') }}
@endsection

@section('content-wrapper')
    <div class="auth-content form-container">
        <div class="container">
            <div class="col-lg-10 col-md-12 offset-lg-1">
                <div class="heading">
                    <h2 class="fs24 fw6">
                        {{ __('rma::app.shop.guest-users.heading') }}
                    </h2>
                </div>

                <div class="body col-12">
                    <form
                        method="POST"
                        @submit.prevent="onSubmit"
                        action="{{ route('rma.guest.logincreate') }}">

                        {{ csrf_field() }}

                        {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                        <div class="form-group" :class="[errors.has('order_id') ? 'has-error' : '']">
                            <label for="email" class="mandatory label-style">
                                {{ __('rma::app.shop.guest-users.order-id') }}
                            </label>

                            <input
                                type="text"
                                class="form-style"
                                name="order_id"
                                value="{{ old('order_id') }}"
                                v-validate="'required|integer'"
                                data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;" />

                            <span class="control-error" v-if="errors.has('order_id')">
                                @{{ errors.first('order_id') }}
                            </span>
                        </div>

                        <div class="form-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="password" class="mandatory label-style">
                                {{ __('rma::app.shop.guest-users.email') }}
                            </label>

                            <input
                                type="email"
                                class="form-style"
                                name="email"
                                v-validate="'required'"
                                value="{{ old('email') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;" />

                            <span class="control-error" v-if="errors.has('email')">
                                @{{ errors.first('email') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                        <input class="theme-btn" type="submit" value="{{ __('rma::app.shop.guest-users.button-text') }}" />

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
