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
                <div class="account-head mb-30">
                    <span class="account-heading">
                        {{ __('gdpr::app.shop.customer-gdpr-data-request.heading') }}
                    </span>
                </div>

                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'data-request-tab')" id="defaultOpen">
                        {{ __('gdpr::app.shop.customer-gdpr-data-request.request-data-access') }}
                    </button>
                    <button class="tablinks" onclick="openTab(event, 'data-update-tab')">
                        {{ __('gdpr::app.shop.customer-gdpr-data-request.request-data-update') }}
                    </button>
                    <button class="tablinks" onclick="openTab(event, 'data-delete-tab')">
                        {{ __('gdpr::app.shop.customer-gdpr-data-request.request-to-delete-account') }}
                    </button>
                </div>

  
                <div class="tabs-content">
                    <div class="sale-container">
                        <form
                            method="POST"
                            onSubmit="return update_request_validate(event)"
                            enctype="multipart/form-data"
                            name="update_request_form"
                            action="{{ route('gdpr.customer.store') }}">

                            @csrf()
                            <div id="data-request-tab" class="tabcontent">
                                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                                <div class="sale-section no-border">
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
                            </div>

                            <div id="data-update-tab" class="tabcontent">
                                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                                <div class="sale-section no-border">
                                    <div class="account-head mb-10">
                                        <span class="account-heading">
                                            {{ __('gdpr::app.shop.customer-gdpr-data-request.request-data-update') }}
                                        </span>
                                        <div class="horizontal-rule"></div>
                                    </div>
                                    <div class="sale-title">
                                        <div class="section-title required label-style">
                                            {{ __('gdpr::app.shop.customer-gdpr-data-request.update-description') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="control-group col-12">
                                            <input type="hidden"
                                            id="request_type" 
                                            name="request_type"
                                            value="{{ __('gdpr::app.shop.customer-gdpr-data-request.request-type-update') }}">

                                            <textarea class="control"
                                            id="update_message"
                                            name="update_message"
                                            maxlength="500"></textarea> 
                                        </div>
                                        <div class="control-group">
                                            <button type="submit" class="btn btn-lg btn-primary" style="display: inline-block; width: auto; margin-left: 16px; margin-top: -20px;">
                                                {{ __('gdpr::app.shop.customer-gdpr-data-request.submit-request') }}
                                            </button>
                                        </div>
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
                            <div id="data-delete-tab" class="tabcontent">
                                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                                <div class="sale-section no-border">
                                    <div class="account-head mb-10">
                                        <span class="account-heading">
                                            {{ __('gdpr::app.shop.customer-gdpr-data-request.request-to-delete-account') }}
                                        </span>
                                        <div class="horizontal-rule"></div>
                                    </div>
                                    <div class="sale-title">
                                        <div class="section-title required label-style">
                                            {{ __('gdpr::app.shop.customer-gdpr-data-request.delete-reason') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="control-group col-12">
                                            <input type="hidden"
                                            id="request_type"
                                            name="request_type"
                                            value="{{ __('gdpr::app.shop.customer-gdpr-data-request.request-type-delete') }}">

                                            <textarea class="control"
                                            id="delete_message"
                                            name="delete_message"
                                            maxlength="500"></textarea> 
                                        </div>

                                        <div class="control-group">
                                            <button type="submit" class="btn btn-lg btn-primary" id="submit2" style="display: inline-block; width: auto; margin-left: 16px; margin-top: -20px;">
                                                {{ __('gdpr::app.shop.customer-gdpr-data-request.submit-request') }}
                                            </button>
                                        </div>
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

.tab {
  overflow: hidden;
  background-color: #f1f1f1;
  border-radius: 5px;
}

.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

.tab button:hover {
  background-color: #ddd;
}


.tab button.active {
  background-color: #00800061;
}


.tabcontent {
  display: none;
  padding: 6px 12px;
  border-top: none;
}


.topright {
  float: right;
  cursor: pointer;
  font-size: 28px;
}

.sale-section.no-border {
    margin-top: 20px;
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

function openTab(evt, tabID) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabID).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

</script>
@endpush


