<?php

return [
    [
        'key' => 'settings.gdpr',
        'name' => 'gdpr::app.admin.layouts.gdpr',
        'route' => 'admin.gdpr.index',
        'sort' => 9
    ],[
        'key' => 'settings.gdpr.index',
        'name' => 'gdpr::app.admin.gdpr-tab.heading',
        'route' => 'admin.gdpr.index',
        'sort' => 1
    ],[
        'key' => 'customers.gdpr',
        'name' => 'gdpr::app.admin.layouts.gdpr-data-request',
        'route' => 'admin.gdpr.dataRequest',
        'sort' => 6
    ],[
        'key' => 'customers.gdpr.index',
        'name' => 'gdpr::app.admin.gdpr-tab.data-request-heading',
        'route' => 'admin.gdpr.dataRequest',
        'sort' => 1
    ]  
];
