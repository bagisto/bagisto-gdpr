@extends('gdpr::admin.layouts.content')

@section('page_title')
{{ __('gdpr::app.admin.title.data-request') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('gdpr::app.admin.gdpr-tab.data-request-heading') }}</h1>
            </div>

            <div class="page-action">
            </div>
        </div>

        <div class="page-content">

        {!! app('Webkul\GDPR\DataGrids\Admin\GDPRDataRequest')->render() !!}

        </div>
    </div>
@stop