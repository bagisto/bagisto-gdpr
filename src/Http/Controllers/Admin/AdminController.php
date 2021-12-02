<?php

namespace Webkul\GDPR\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Webkul\GDPR\Http\Controllers\Controller;
use Webkul\GDPR\Repositories\GDPRRepository;
use Webkul\GDPR\Mail\AdminUpdateDataRequestMail;
use Webkul\GDPR\Repositories\GDPRDataRequestRepository;
use Illuminate\Support\Facades\DB;
use Artisan;

class AdminController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @var \Illuminate\Http\Response
     */
    protected $_config;


     /**
     * GDPRRepository object
     *
     * @var object
     */
    protected $gdprRepository;


     /**
     * GDPRDataRequestRepository object
     *
     * @var object
     */
    protected $gdprDataRequestRepository;


     /**
     * Create a new controller instance.
     *
     * @param  \Webkul\GDPR\Repositories\GDPRRepository  $gdprRepository
     * @param  \Webkul\GDPR\Repositories\GDPRDataRequestRepository  $gdprDataRequestRepository
     * @return void
     */
    public function __construct(GDPRRepository $gdprRepository,GDPRDataRequestRepository $gdprDataRequestRepository) 
    {
        $this->middleware('admin');
        $this->gdprRepository = $gdprRepository;
        $this->gdprDataRequestRepository = $gdprDataRequestRepository;
        $this->_config = request('_config');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = $this->gdprRepository->first();
        
        return view($this->_config['view'], [
            'gdprData' => $data,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        if(request()->get('enabled_gdpr') == 'on') {
            $gdprStatus = 1;
        } else {
            $gdprStatus = 0;
        }

        if(request()->get('customer_agreement') == 'on') {
            $customerAgreementStatus = 1;
        } else {
            $customerAgreementStatus = 0;
        }

        if(request()->get('enabled_cookie_notice') == 'on') {
            $cookieStatus = 1;
        } else {
            $cookieStatus = 0;
        }

        $params = request()->all() + [
            'gdpr_status'=>$gdprStatus,
            'customer_agreement_status'=>$customerAgreementStatus,
            'cookie_status'=>$cookieStatus
        ];

        $this->gdprRepository->findOneWhere([
            'id' => $id,
        ]);

        $params['agreement_content'] = str_replace('=&gt;', '=>', $params['agreement_content']);

        unset($params['enabled_gdpr']);
        unset($params['customer_agreement']);
        unset($params['enabled_cookie_notice']);

        $this->gdprRepository->update($params, $id);
         
        Artisan::call('optimize');

        session()->flash('success', trans('gdpr::app.admin.create-gdpr.update-success'));
        return redirect()->route($this->_config['redirect']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function customerDataRequest()
    {
        return view($this->_config['view']);   
    }


    /**
    * Show the Data Request edit form
    *
    * @return \Illuminate\View\View
    */
    public function edit($id)
    {
        $data = $this->gdprDataRequestRepository->find($id);
    
        return view($this->_config['view'], compact('data'));
    }

    /**
    * Method to update the Data Request information.
    *
    * @return Mixed
    */
    public function update()
    {
       $data = request()->except('_token');
       $request = $this->gdprDataRequestRepository->where('id',$data['id'])->get();

       foreach($request as $value) {
           $requestData = $value;
       }
       
       $result = $this->gdprDataRequestRepository->find($data['id'])->update($data);

       $params = $data + [
                'customer_id'=>$requestData->customer_id,
                'email'=>$requestData->email,
            ];

        if($result) {
            try {
                    Mail::queue(new AdminUpdateDataRequestMail($params));
                    session()->flash('success', trans('gdpr::app.response.update-success', ['name' => 'Data Request']));      
            } catch(\Exception $e) {
                    session()->flash('success', trans('gdpr::app.response.update-success-unsent-email', ['name' => 'Data Request']));      
            }
        }

        return redirect()->route($this->_config['redirect']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $this->gdprDataRequestRepository->delete($id);
            session()->flash('success', trans('gdpr::app.response.delete-success', ['name' => 'Data Request']));

        } catch (\Exception $e) {
            session()->flash('error', trans( 'gdpr::app.response.attribute-reason-error', ['name' => 'Data Request']));
        }

        return redirect()->back();
    }
}
