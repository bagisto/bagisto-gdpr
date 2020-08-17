<?php

namespace Webkul\GDPR\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class RepositoryServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\GDPR\Models\GDPR::class,
        \Webkul\GDPR\Models\GDPRDataRequest::class,
        
    ];
}