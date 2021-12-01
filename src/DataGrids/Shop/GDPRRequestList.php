<?php

namespace Webkul\GDPR\DataGrids\Shop;

use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class GDPRRequestList extends DataGrid
{
    /**
     * @var integer
     */
    protected $index = 'id';
    protected $sortOrder = 'desc'; //asc or desc

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->invoker = $this;
    }

    public function prepareQueryBuilder()
    {
        $customerId = auth()->guard('customer')->user()->id;
       
        $queryBuilder = DB::table('gdpr_data_request as gdpr')
                                 ->addSelect('gdpr.id','gdpr.request_status','gdpr.request_type','gdpr.message','gdpr.created_at','gdpr.updated_at')
                                 ->where('gdpr.customer_id', $customerId);

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' =>  'id',
            'label' => trans('gdpr::app.shop.customer-index-field.id'),
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        
        ]);

        $this->addColumn([
            'index' => 'request_status',
            'label' => trans('gdpr::app.shop.customer-index-field.request-status'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => false,
            'filterable' => false,
         
        ]);

        $this->addColumn([
            'index' => 'request_type',
            'label' => trans('gdpr::app.shop.customer-index-field.request_type'),
            'type' => 'string',
            'sortable' => false,
            'searchable' => true,
            'filterable' => false,
           
        ]);

        $this->addColumn([
            'index' => 'message',
            'label' => trans('gdpr::app.shop.customer-index-field.message'),
            'type' => 'string',
            'sortable' => false,
            'searchable' => true,
            'filterable' => false,
           
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('gdpr::app.shop.customer-index-field.created-at'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true

        ]);

        $this->addColumn([
            'index' => 'updated_at',
            'label' => trans('gdpr::app.shop.customer-index-field.updated-at'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
            
        ]);
    }
}
