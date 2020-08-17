<?php
Route::group(['middleware' => ['web']], function () {
    Route::prefix('admin/gdpr')->group(function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::namespace('Webkul\GDPR\Http\Controllers\Admin')->group(function () {        
                 //admin routes for all requests
                 Route::get('/', 'AdminController@index')->defaults('_config', [
                      'view' => 'gdpr::admin.allgdpr.index',
                    ])->name('admin.gdpr.index');

                 Route::post('/store/{id}', 'AdminController@store')->defaults('_config', [
                        'redirect' => 'admin.gdpr.index',
                    ])->name('admin.gdpr.store');

                 Route::get('/requests', 'AdminController@customerDataRequest')->defaults('_config', [
                        'view' => 'gdpr::admin.allgdpr.dataRequest',
                    ])->name('admin.gdpr.dataRequest');

                 Route::get('requests/edit/{id}', 'AdminController@edit')->defaults('_config', [
                        'view' => 'gdpr::admin.allgdpr.edit',
                    ])->name('admin.gdpr.edit');

                 Route::post('/update', 'AdminController@update')->defaults('_config', [
                        'redirect' => 'admin.gdpr.dataRequest',
                    ])
                    ->name('admin.gdpr.update');
    
                 Route::get('/delete/{id}', 'AdminController@delete')
                    ->name('admin.gdpr.delete');

            });
        });
    });
});
?>


