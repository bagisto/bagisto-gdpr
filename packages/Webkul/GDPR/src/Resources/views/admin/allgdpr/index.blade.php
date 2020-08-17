@extends('gdpr::admin.layouts.content')
@inject('request', 'Illuminate\Http\Request')

@section('page_title')
{{ __('gdpr::app.admin.title.index') }}
@stop

@section('content')
    <div class="content">
        <form
            method="POST"
            enctype="multipart/form-data"
            @if ($gdprData)
                action="{{ route('admin.gdpr.store', ['id' => $gdprData->id]) }}"
            @else
                action="{{ route('admin.gdpr.store', ['id' => 'new']) }}"
            @endif
            >
            @csrf

            <div class="page-header">
                <div class="page-title">
                    <h1>{{ __('gdpr::app.admin.gdpr-tab.heading') }}</h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('gdpr::app.admin.create-gdpr.update-gdpr-data') }}
                    </button>
                </div>
            </div>
            
             <accordian :title="'{{ __('gdpr::app.admin.create-gdpr.general') }}'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.enabled-gdpr') }}</label>

                        <label class="switch">
                            <input
                                id="enabled_gdpr"
                                name="enabled_gdpr"
                                type="checkbox"
                                class="control"
                                data-vv-as="&quot;enabled_gdpr&quot;"
                                {{ $gdprData && $gdprData->gdpr_status ? 'checked' : ''}} />
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </accordian>
            <accordian :title="'{{ __('gdpr::app.admin.create-gdpr.customer-agreement') }}'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.enabled-customer-data-agreement') }}</label>

                        <label class="switch">
                            <input
                                id="customer_agreement"
                                name="customer_agreement"
                                type="checkbox"
                                class="control"
                                data-vv-as="&quot;customer_agreement&quot;"
                                {{ $gdprData && $gdprData->customer_agreement_status ? 'checked' : ''}} />
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.agreement-checkbox-label') }}</label>

                        <textarea class="control" id="agreement_label" name="agreement_label">{{ $gdprData->agreement_label }}</textarea>
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.agreement-content') }}</label>

                        <textarea
                            class="control"
                            id="agreement_content"
                            name="agreement_content">
                            {{ $gdprData ? $gdprData->agreement_content : '' }}
                        </textarea>
                    </div>
                </div>
            </accordian>
            <accordian :title="'{{ __('gdpr::app.admin.create-gdpr.cookie-message-settings') }}'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.enabled-cookie-notice') }}</label>

                        <label class="switch">
                            <input
                                id="enabled_cookie_notice"
                                name="enabled_cookie_notice"
                                type="checkbox"
                                class="control"
                                data-vv-as="&quot;enabled_cookie_notice&quot;"
                                {{ $gdprData && $gdprData->cookie_status ? 'checked' : ''}} />
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.cookie-block-display-position') }}</label>

                        <select class="control" id="cookie_block_position" name="cookie_block_position">
                              <option value="bottom-right">
                                   Bottom Right
                              </option>
                              <option value="bottom-left">
                                    Bottom Left
                              </option>
                        </select>   
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.cookie-static-block-identifier') }}</label>

                        <input
                            type="text"
                            class="control"
                            id="cookie_static_block_identifier"
                            name="cookie_static_block_identifier"
                            value="{{$gdprData->cookie_static_block_identifier}}" />
                    </div>
                </div>
            </accordian>
            <accordian :title="'{{ __('gdpr::app.admin.create-gdpr.email-templates-settings') }}'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.data-update-request-template') }}</label>

                        <select class="control" id="data_update_request_template" name="data_update_request_template">
                              <option value="data-update-request-template">
                                    Data Update Request (Default)
                              </option>
                              <option value="another">
                                    Data Update Request 1
                              </option>
                        </select>   
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.data-delete-request-template') }}</label>

                        <select class="control" id="data_delete_request_template" name="data_delete_request_template">
                              <option value="data-delete-request-template">
                                    Data Delete Request (Default)
                              </option>
                              <option value="another">
                                    Data Delete Request 1
                              </option>
                        </select>   
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.request-status-update-template') }}</label>

                        <select class="control" id="request_status_update_template" name="request_status_update_template">
                              <option value="request-status-update-template">
                                    Request Status Update (Default)
                              </option>
                              <option value="another">
                                    Request Status Update 1
                              </option>
                        </select>   
                    </div>

                    <div class="control-group">
                        <label>{{ __('gdpr::app.admin.create-gdpr.request-status-delete-template') }}</label>

                        <select class="control" id="request_status_delete_template" name="request_status_delete_template">
                              <option value="request-status-delete-template">
                                    Request Status Delete (Default)
                              </option>
                              <option value="another">
                                    Request Status Delete 1
                              </option>
                        </select>   
                    </div>
                </div>
            </accordian>

        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                height: 200,
                width: "100%",
                image_advtab: true,
                valid_elements : '*[*]',
                selector: 'textarea#agreement_content',
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
            });
        });
    </script>
@endpush

