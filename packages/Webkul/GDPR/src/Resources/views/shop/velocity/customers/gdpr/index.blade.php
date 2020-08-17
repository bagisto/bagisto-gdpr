@extends('shop::customers.account.index')

@section('page_title')
    {{ __('gdpr::app.shop.customer.title') }}
@endsection

@if (auth()->guard('customer')->user())
    @section('page-detail-wrapper')
@else
    @section('content-wrapper')
        <div class="account-content row no-margin velocity-divide-page">
            <div class="account-layout full-width mt10">
@endif

<div class="account-table-content">
        <div class="tabs-content">
                <div class="account-head mb-30">
                    <span class="account-heading">
                        {{ __('gdpr::app.shop.customer-gdpr-data-request.heading') }}
                    </span>
                </div>

                <div class="sale-container">
                <form
                    method="POST"
                    onSubmit="return update_request_validate(event)"
                    enctype="multipart/form-data"
                    name="update_request_form"
                    action="{{ route('gdpr.customer.store') }}">

                     @csrf()
                    <div class="sale-section">
                        <div class="account-head mb-10">
                             <span class="account-heading">
                             {{ __('gdpr::app.shop.customer-gdpr-data-request.request-data-access') }}
                             </span>
                             <div class="horizontal-rule"></div>
                        </div>
                        <div class="control-group">
                            <a href="{{ route('gdpr.customers.pdfview',['download'=>'pdf']) }}">
                            <label class="btn btn-lg btn-primary" style="display: inline-block; width: auto;">
                                {{ __('gdpr::app.shop.customer-gdpr-data-request.get-pdf') }}
                            </label>
                            </a>
                        </div>
                        <div class="control-group">
                             <a href="{{ route('gdpr.customers.htmlview') }}" target="_blank">
                             <label class="btn btn-lg btn-primary" style="display: inline-block; width: auto;">
                                {{ __('gdpr::app.shop.customer-gdpr-data-request.get-html') }}
                             </label>
                             </a>
                        </div>
                    </div>

                    <div class="sale-section no-border">
                        <div class="account-head mb-10">
                             <span class="account-heading">
                             {{ __('gdpr::app.shop.customer-gdpr-data-request.request-data-update') }}
                             </span>
                             <div class="horizontal-rule"></div>
                        </div>
                        <div class="sale-title">
                            <div class="section-title">
                                {{ __('gdpr::app.shop.customer-gdpr-data-request.update-description') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-12">
                                <input type="hidden" id="request_type" name="request_type" value="{{ __('gdpr::app.shop.customer-gdpr-data-request.request-type-update') }}">
                                <textarea class="control" id="update_message" name="update_message"></textarea> 
                            </div>
                            <div class="control-group">
                                <button type="submit" class="btn btn-lg btn-primary" style="display: inline-block; width: auto; margin-left: 16px; margin-top: -20px;">
                                {{ __('gdpr::app.shop.customer-gdpr-data-request.submit-request') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form> 
                <form
                    method="POST"
                    onSubmit="return delete_request_validate(event)"
                    enctype="multipart/form-data"
                    name="delete_request_form"
                    action="{{ route('gdpr.customer.store') }}">

                     @csrf()
                    <div class="sale-section no-border">
                        <div class="account-head mb-10">
                             <span class="account-heading">
                             {{ __('gdpr::app.shop.customer-gdpr-data-request.request-to-delete-account') }}
                             </span>
                             <div class="horizontal-rule"></div>
                        </div>
                        <div class="sale-title">
                            <div class="section-title">
                                {{ __('gdpr::app.shop.customer-gdpr-data-request.delete-reason') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-12">
                                <input type="hidden" id="request_type" name="request_type" value="{{ __('gdpr::app.shop.customer-gdpr-data-request.request-type-delete') }}">
                                <textarea class="control" id="delete_message" name="delete_message"></textarea> 
                            </div>

                            <div class="control-group">
                                <button type="submit" class="btn btn-lg btn-primary" id="submit2" style="display: inline-block; width: auto; margin-left: 16px; margin-top: -20px;">
                                    {{ __('gdpr::app.shop.customer-gdpr-data-request.submit-request') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                    <div class="sale-section no-border">
                        <div class="account-head mb-10">
                             <span class="account-heading">
                             {{ __('gdpr::app.shop.customer-gdpr-data-request.request-list') }}
                             </span>
                        </div>

                        {!! view_render_event('customer.account.gdpr.list.before') !!}
                         <div class="account-table-content">
    
                           {!! app('Webkul\GDPR\DataGrids\GDPRRequestList')->render() !!}

                         </div>
                        {!! view_render_event('customer.account.gdpr.list.after') !!}


                    </div>
                </div>
        </div>
    </div>
@if (! auth()->guard('customer')->user())
    </div>
</div>
@endif

@endsection

<style>

.horizontal-rule {
        margin-top: 1.1%;
        width: 100%;
        height: 1px;
        vertical-align: middle;
        background: #c7c7c7;
    }

</style>

@push('scripts')
<script>

function update_request_validate(e)
{  
    if (update_request_form.update_message.value=="")
    {
        alert("Update Description should not be blank");
        e.preventDefault();
        update_request_form.update_message.focus();
        return false;
    }
}

function delete_request_validate(e)
{  
    if (delete_request_form.delete_message.value=="")
    {
        alert("Delete Description should not be blank");
        e.preventDefault();
        delete_request_form.delete_message.focus();
        return false;
    }
}

</script>
@endpush

