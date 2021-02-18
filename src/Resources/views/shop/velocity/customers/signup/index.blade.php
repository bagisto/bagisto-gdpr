@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="auth-content form-container">
        <div class="container">
            <div class="col-lg-10 col-md-12 offset-lg-1">
                <div class="heading">
                    <h2 class="fs24 fw6">
                        {{ __('velocity::app.customer.signup-form.user-registration')}}
                    </h2>

                    <a href="{{ route('customer.session.index') }}" class="btn-new-customer">
                        <button type="button" class="theme-btn light">
                            {{ __('velocity::app.customer.signup-form.login')}}
                        </button>
                    </a>
                </div>

                <div class="body col-12">
                    <h3 class="fw6">
                        {{ __('velocity::app.customer.signup-form.become-user')}}
                    </h3>

                    <p class="fs16">
                        {{ __('velocity::app.customer.signup-form.form-sginup-text')}}
                    </p>

                    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

                    <form
                        method="post"
                        action="{{ route('customer.register.create') }}"
                        @submit.prevent="onSubmit">

                        {{ csrf_field() }}

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                        <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                            <label for="first_name" class="required label-style">
                                {{ __('shop::app.customer.signup-form.firstname') }}
                            </label>

                            <input
                                type="text"
                                class="form-style"
                                name="first_name"
                                v-validate="'required'"
                                value="{{ old('first_name') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('first_name')">
                                @{{ errors.first('first_name') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}

                        <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                            <label for="last_name" class="required label-style">
                                {{ __('shop::app.customer.signup-form.lastname') }}
                            </label>

                            <input
                                type="text"
                                class="form-style"
                                name="last_name"
                                v-validate="'required'"
                                value="{{ old('last_name') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('last_name')">
                                @{{ errors.first('last_name') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}

                        <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email" class="required label-style">
                                {{ __('shop::app.customer.signup-form.email') }}
                            </label>

                            <input
                                type="email"
                                class="form-style"
                                name="email"
                                v-validate="'required|email'"
                                value="{{ old('email') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;" />

                            <span class="control-error" v-if="errors.has('email')">
                                @{{ errors.first('email') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.email.after') !!}

                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password" class="required label-style">
                                {{ __('shop::app.customer.signup-form.password') }}
                            </label>

                            <input
                                type="password"
                                class="form-style"
                                name="password"
                                v-validate="'required|min:6'"
                                ref="password"
                                value="{{ old('password') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;" />

                            <span class="control-error" v-if="errors.has('password')">
                                @{{ errors.first('password') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.password.after') !!}

                        <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                            <label for="password_confirmation" class="required label-style">
                                {{ __('shop::app.customer.signup-form.confirm_pass') }}
                            </label>

                            <input
                                type="password"
                                class="form-style"
                                name="password_confirmation"
                                v-validate="'required|min:6|confirmed:password'"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;" />

                            <span class="control-error" v-if="errors.has('password_confirmation')">
                                @{{ errors.first('password_confirmation') }}
                            </span>
                        </div>

                        <?php
                        $gdprRepository = app('Webkul\GDPR\Repositories\GDPRRepository');

                        $gdpr = $gdprRepository->get();

                        foreach ($gdpr as $value) {
                            $gdprData = $value;
                        }
                        try{
                            if($gdprData && $gdprData->customer_agreement_status == 1){
                        ?>
            
                        <div class="control-group" :class="[errors.has('agreement') ? 'has-error' : '']">

                            <input type="checkbox" id="checkbox2" name="agreement" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.agreement') }}&quot;">
                            <label class="required label-style" style="position: absolute; margin-left: 0px;">
                                <a href="#" @click="myFunction">{{ $gdprData->agreement_label }}</a>              
                            </label>
                            <span class="control-error" style="position: absolute; margin-top: 20px;" v-if="errors.has('agreement')">@{{ errors.first('agreement') }}</span>
                        </div> 
                        
                        <!-- Modal -->
                        <modal-view></modal-view>
                    
                        <?php
                            }
                        }catch(\Exception $e){}
                        ?>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                        <button class="theme-btn" type="submit">
                            {{ __('shop::app.customer.signup-form.title') }}
                        </button>
                    </form>

                    {!! view_render_event('bagisto.shop.customers.signup.after') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/x-template" id="modalView">
<template>
    <div class="modal-parent scrollable" style="display:none" id="modal_view">
        <div class="modal-container">
            
            <div id="close-button">
                    <button id="x" style="float: right; margin-top: 10px; margin-right: 15px; font-size: 1.5rem; border: none; background-color: white;" @click="closeModal">X</button>
            </div>
            
            <div class="modal-header">
                <slot name="header">
                    Terms & Conditions
                </slot>
            </div>
        
            <div class="modal-body">
                <slot name="body">
                @php
                    try{
                        if($gdprData && $gdprData->customer_agreement_status == 1){
                @endphp
                
                    {!! $gdprData->agreement_content !!}

                @php
                            }
                        }catch(\Exception $e){}
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
