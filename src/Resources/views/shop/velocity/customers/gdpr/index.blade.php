@extends('shop::customers.account.index')

@section('page_title')
    {{ __('gdpr::app.shop.customer.title') }}
@endsection

@section('page-detail-wrapper')

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
                <form method="POST" onSubmit="return update_request_validate(event)" enctype="multipart/form-data" name="update_request_form" action="{{ route('gdpr.customer.store') }}">
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
                                <a href="{{ route('gdpr.customers.pdfview',['download'=>'pdf']) }}" class="btn btn-sm btn-primary">
                                    {{ __('gdpr::app.shop.customer-gdpr-data-request.get-pdf') }}
                                </a>
                            </div>

                            <div class="control-group">
                                <a href="{{ route('gdpr.customers.htmlview') }}" target="_blank" class="btn btn-sm btn-primary">
                                    {{ __('gdpr::app.shop.customer-gdpr-data-request.get-html') }}
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
                                    <input type="hidden" id="request_type" name="request_type" value="{{ __('gdpr::app.shop.customer-gdpr-data-request.request-type-update') }}">
                                    <textarea class="control" id="update_message" name="update_message" maxlength="500"></textarea> 
                                </div>
                                <div class="control-group">
                                    <button type="submit" class="btn btn-sm btn-primary request-submit-btn">
                                        {{ __('gdpr::app.shop.customer-gdpr-data-request.submit-request') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 

                <form method="POST" onSubmit="return delete_request_validate(event)" enctype="multipart/form-data" name="delete_request_form" action="{{ route('gdpr.customer.store') }}">
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
                                    <input type="hidden" id="request_type" name="request_type" value="{{ __('gdpr::app.shop.customer-gdpr-data-request.request-type-delete') }}">
                                    <textarea class="control" id="delete_message" name="delete_message" maxlength="500"></textarea> 
                                </div>

                                <div class="control-group">
                                    <button type="submit" class="btn btn-sm btn-primary request-submit-btn" id="submit2">
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
                        {!! app('Webkul\GDPR\DataGrids\Shop\GDPRRequestList')->render() !!}
                    </div>

                    {!! view_render_event('customer.account.gdpr.list.after') !!}

                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>

    function update_request_validate(e)
    {  
        if (update_request_form.update_message.value == "") {

            alert("Update Description should not be blank");
            e.preventDefault();
            update_request_form.update_message.focus();

            return false;
        }
    }

    function delete_request_validate(e)
    {  
        if (delete_request_form.delete_message.value == "") {

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


