<?php
    Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
        Route::prefix('customer/account/gdpr')->group(function () {
            Route::namespace('Webkul\GDPR\Http\Controllers\Customer')->group(function () {
       
                Route::get('/', 'CustomerController@index')->defaults('_config', [
                    'view' => 'gdpr::shop.customers.gdpr.index',
                    ])->name('gdpr.customers.allgdpr');
                    
                Route::post('/store', 'CustomerController@store')->defaults('_config', [
                    'redirect' => 'gdpr.customers.allgdpr',
                    ])->name('gdpr.customer.store');

                Route::get('/pdfview', 'CustomerController@pdfview')->defaults('_config', [
                    'view' => 'gdpr::shop.customers.gdpr.pdfview',
                    ])->name('gdpr.customers.pdfview');
                
                Route::get('/htmlview', 'CustomerController@htmlview')->defaults('_config', [
                    'view' => 'gdpr::shop.customers.gdpr.pdfview',
                    ])->name('gdpr.customers.htmlview');
                    
            });  
            
        });

    });





