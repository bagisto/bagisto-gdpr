<?php

namespace Webkul\GDPR\DataGrids\Admin;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

class GDPRDataRequest extends DataGrid
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
        $customerId = NULL;

        if (auth()->guard('customer')->user()) {
          
            $customerId = auth()->guard('customer')->user()->id;
        }

       
        $queryBuilder = DB::table('gdpr_data_request as gdpr')
                                 ->addSelect('gdpr.id',
                                             'gdpr.customer_id',
                                             'gdpr.request_status',
                                             'gdpr.request_type',
                                             'gdpr.message',
                                             'gdpr.created_at',
                                             'gdpr.updated_at');
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
            'index' =>  'customer_id',
            'label' => trans('gdpr::app.shop.customer-index-field.customer_id'),
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

    public function prepareActions()
    {
        $routeName = request()->route()->getName();

        if ($routeName == 'admin.gdpr.dataRequest' && auth()->guard('admin')->user()) {
            $route_for_edit = 'admin.gdpr.edit';
            $route_for_delete = 'admin.gdpr.delete';
        }

        $this->addAction([
            'method' => 'GET',
            'route'  => 'admin.gdpr.edit',
            'icon'   => 'icon pencil-lg-icon',
            'title'  => trans('gdpr::app.admin.data-request.edit-data-request'),
        ]);

        $this->addAction([
            'method' => 'GET',
            'route'  => 'admin.gdpr.delete',
            'icon'   => 'icon trash-icon',
            'title'  => trans('gdpr::app.admin.data-request.delete-data-request'),
        ]);
    }
}
