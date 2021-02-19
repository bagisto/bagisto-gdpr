<?php

namespace Webkul\GDPR\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Webkul\GDPR\Http\Controllers\Controller;
use Webkul\GDPR\Repositories\GDPRRepository;
use Webkul\GDPR\Mail\AdminUpdateDataRequestMail;
use Webkul\GDPR\Repositories\GDPRDataRequestRepository;
use DB;




class AdminController extends Controller
{

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

    protected $_config;

   

    public function __construct(GDPRRepository $gdprRepository,GDPRDataRequestRepository $gdprDataRequestRepository) 
    {
        $this->isGuest = 1;

        if (auth()->guard('customer')->user()) {
            $this->isGuest = 0;
            $this->middleware('customer');
        }

        $this->_config = request('_config');

        $this->gdprRepository = $gdprRepository;
        $this->gdprDataRequestRepository = $gdprDataRequestRepository;
    }

    public function index()
    {
        
        $data = $this->gdprRepository->get();
        
        return view($this->_config['view'], [
            'gdprData' => $data['0'],
        ]);
        
    }

    public function store($id)
    {
            if(request()->get('enabled_gdpr') == 'on')
            {
                $gdprStatus = 1;
            }else{
                $gdprStatus = 0;
            }

            if(request()->get('customer_agreement') == 'on')
            {
                $customerAgreementStatus = 1;
            }else{
                $customerAgreementStatus = 0;
            }

            if(request()->get('enabled_cookie_notice') == 'on')
            {
                $cookieStatus = 1;
            }else{
                $cookieStatus = 0;
            }

            $params = request()->all() + [
                'gdpr_status'=>$gdprStatus,
                'customer_agreement_status'=>$customerAgreementStatus,
                'cookie_status'=>$cookieStatus
            ];

        $gdprData = $this->gdprRepository->findOneWhere([
            'id' => $id,
        ]);

        $params['agreement_content'] = str_replace('=&gt;', '=>', $params['agreement_content']);

        unset($params['enabled_gdpr']);
        unset($params['customer_agreement']);
        unset($params['enabled_cookie_notice']);

        $data = $this->gdprRepository->update($params, $id);

        session()->flash('success', trans('gdpr::app.admin.create-gdpr.update-success'));
        return redirect()->route($this->_config['redirect']);
    }

    public function customerDataRequest()
    {
        return view($this->_config['view']);   
    }

    public function edit($id)
    {
        $data = $this->gdprDataRequestRepository->find($id);
    
        return view($this->_config['view'], compact('data'));
    }

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

         if($result)
            {
                try{
                        Mail::queue(new AdminUpdateDataRequestMail($params));

                        session()->flash('success', trans('gdpr::app.response.update-success', ['name' => 'Data Request']));
                        
                 }catch (\Exception $e) {

                        session()->flash('success', trans('gdpr::app.response.update-success-unsent-email', ['name' => 'Data Request']));      
                }
            }

       return redirect()->route($this->_config['redirect']);
    }

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
