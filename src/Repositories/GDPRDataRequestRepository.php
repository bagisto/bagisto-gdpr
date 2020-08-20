<?php

namespace Webkul\GDPR\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;

class GDPRDataRequestRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Webkul\GDPR\Contracts\GDPRDataRequest';
    }

    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
    }
}