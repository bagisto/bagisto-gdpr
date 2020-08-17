<?php

namespace Webkul\GDPR\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;

class GDPRRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Webkul\GDPR\Contracts\GDPR';
    }

    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
    }
}