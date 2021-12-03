<?php

namespace Webkul\GDPR\Http\Controllers\Customer;

use Webkul\GDPR\Http\Controllers\Controller;
use Cookie;


class CookieController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @var \Illuminate\Http\Response
     */
    protected $_config;


    public function __construct()
    { 
        $this->_config = request('_config');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }
    
}
