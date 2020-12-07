@extends('admin::layouts.content')

@section('page_title')
{{ __('gdpr::app.admin.title.edit') }}
@stop

@section('content')
<div class="content">
    <form method="POST" action="{{ route('admin.gdpr.update') }}" @submit.prevent="onSubmit">
        <input type="hidden" name="id" value="{{ $data['id'] }}">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/requests') }}';">
                    </i>
                    {{ __('gdpr::app.admin.title.edit-heading') }}
                </h1>
            </div>

            <div class="page-action">
                <button type="submit" class="btn btn-lg btn-primary">
                    {{ __('gdpr::app.admin.create-gdpr.save-btn') }}
                </button>
            </div>
        </div>

        <div class="page-content">
            @csrf()

            <accordian :title="'{{ __('gdpr::app.admin.create-gdpr.general-data-request') }}'" :active="true">
                <div slot="body">

                
                    <div class="control-group" :class="[errors.has('request_status') ? 'has-error' : '']">
                        <label for="request_status"
                            class="required">{{ __('gdpr::app.shop.customer-index-field.request-status') }}</label>

                        <select class="control" v-validate="'required'" id="request_status" name="request_status"
                            data-vv-as="&quot;{{ __('gdpr::app.admin.customer-index-field.request-status') }}&quot;">
                            @php($request_status = ['Pending','Processing','Declined','Complete'])
                            @foreach($request_status as $status_val)
                            @if($status_val == 'Pending')
                            @php($options = 'Pending')
                            @elseif($status_val == 'Processing')
                            @php($options = 'Processing')
                            @elseif($status_val == 'Declined')
                            @php($options = 'Declined')
                            @else
                            @php($options = 'Complete')
                            @endif
                            <option value="{{ $status_val }}" @if($status_val==$data['request_status']) selected @endif>
                                {{ $options }}
                            </option>
                            @endforeach
                        </select>

                        <span class="control-error" v-if="errors.has('request_status')">@{{ errors.first('request_status') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('request_type') ? 'has-error' : '']">
                        <label for="request_type"
                            class="required">{{ __('gdpr::app.shop.customer-index-field.request_type') }}</label>

                        <select class="control" v-validate="'required'" id="request_type" name="request_type" disabled 
                            data-vv-as="&quot;{{ __('gdpr::app.admin.customer-index-field.request_type') }}&quot;">
                            @php($request_type = ['Update','Delete'])
                            @foreach($request_type as $status_val)
                            @if($status_val == 'Update')
                            @php($options = 'Update')
                            @else
                            @php($options = 'Delete')
                            @endif


                            <option value="{{ $status_val }}" @if($status_val==$data['request_type']) selected @endif>
                                {{ $options }}
                            </option>
                            @endforeach
                        </select>

                        <span class="control-error" v-if="errors.has('request_type')">@{{ errors.first('request_type') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('message') ? 'has-error' : '']">
                        <label for="message"b
                            class="required">{{ __('gdpr::app.shop.customer-index-field.message') }}</label>
                        
                        <textarea v-validate="'required'" class="control" id="message" maxlength="500" name="message" data-vv-as="&quot;{{ __('gdpr::app.shop.customer-index-field.message') }}&quot;">{{ $data['message'] }}</textarea>
                        <span class="control-error" v-if="errors.has('message')">@{{ errors.first('message') }}</span>
                    </div>

                </div>
            </accordian>

        </div>

    </form>
</div>
@stop

@push('scripts')
<script>
    $(document).ready(function () {
            $('.label .cross-icon').on('click', function(e) {
                $(e.target).parent().remove();
            })

            $('.actions .trash-icon').on('click', function(e) {
                $(e.target).parents('tr').remove();
            })
        });
</script>
@endpush