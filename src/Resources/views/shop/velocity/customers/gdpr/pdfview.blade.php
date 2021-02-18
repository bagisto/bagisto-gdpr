<html>
    <head>
        <meta http-equiv="Cache-control" content="no-cache">
        <style>
            .hcol{
                    color: #FF0000;
                    text-decoration: underline;
                    margin-bottom:30px;
                }
            .td_width{
                        width:5%;
                }
            .heading{
                    color: blue;
            }
</style>

    </head>

    <body style="background-image: none;background-color: #fff;">
        <div class="container">
            <h1 class="hcol">Default Store View</h1>
                <div class="invoice-summary">
                    <h2> Account Information </h2>
                        <div class="table address">
                            <br>
                                <div>
                                    <div>
                                        <label>First Name</label>
                                        @if($param['customerInformation']->first_name)
                                            <span>{{ $param['customerInformation']->first_name }}</span>
                                        @else
                                            <span>#NA</span>
                                        @endif
                                    </div>
                                    <div>
                                        <label>Last Name</label>
                                        @if($param['customerInformation']->last_name)
                                            <span>{{ $param['customerInformation']->last_name }}</span>
                                        @else
                                            <span>#NA</span>
                                        @endif
                                    </div>
                                    <div>
                                        <label>Email</label>
                                        @if($param['customerInformation']->email)
                                            <span>{{ $param['customerInformation']->email }}</span>
                                        @else
                                            <span>#NA</span>
                                        @endif
                                    </div>
                                    <div>
                                        <label>Gender</label>
                                        @if($param['customerInformation']->gender)
                                            <span>{{ $param['customerInformation']->gender }}</span>
                                        @else
                                            <span>#NA</span>
                                        @endif
                                    </div>
                                    <div>
                                        <label>Date Of Birth</label>
                                        @if($param['customerInformation']->date_of_birth)
                                            <span>{{ $param['customerInformation']->date_of_birth }}</span>
                                        @else
                                            <span>#NA</span>
                                        @endif
                                    </div>
                                    <div>
                                        <label>Phone</label>
                                        @if($param['customerInformation']->phone)
                                            <span>{{ $param['customerInformation']->phone }}</span>
                                        @else
                                            <span>#NA</span>
                                        @endif
                                    </div>
                                </div>
                            <br>
                        </div>                  
    
                    <h2> Address Information</h2>
                        <div class="table address">
                            @if(isset($param['address']))
                                @foreach($param['address'] as $params)
                                    <br>
                                        <div>
                                            <div class="heading">Address - {{$params->id}}</div>
                                            <div>
                                                <label>City</label>
                                                @if($params->city)
                                                    <span>{{ $params->city }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Company</label>
                                                @if($params->company_name)
                                                    <span>{{ $params->company_name }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Country</label>
                                                @if($params->country)
                                                    <span>{{ core()->country_name($params->country) }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>First Name</label>
                                                @if($params->first_name)
                                                    <span>{{ $params->first_name }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Last name</label>
                                                @if($params->last_name)
                                                    <span>{{ $params->last_name }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Phone</label>
                                                @if($params->phone)
                                                    <span>{{ $params->phone }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                        </div>
                                    <br>
                                 @endforeach
                            @endif   
                        </div> 

                    <h2> Order Information</h2>
                        <div class="table address">
                            @if(isset($param['order']))
                                @foreach($param['order'] as $params)
                                    <br>
                                        <div>
                                            <div class="heading" align="left">Order - {{$params->id}}</div>
                                            <div>
                                                <label>Order ID</label>
                                                @if($params->id)
                                                    <span>{{ $params->id }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Status</label>
                                                @if($params->status)
                                                    <span>{{ $params->status }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Shipping</label>
                                                @if($params->shipping_title)
                                                    <span>{{ $params->shipping_title }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Customer First Name</label>
                                                @if($params->customer_first_name)
                                                    <span>{{ $params->customer_first_name }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Customer Last Name</label>
                                                @if($params->customer_last_name)
                                                    <span>{{ $params->customer_last_name }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Customer Company Name</label>
                                                @if($params->company_name)
                                                    <span>{{ $params->company_name }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Order Quantity</label>
                                                @if($params->total_qty_ordered)
                                                    <span>{{ $params->total_qty_ordered }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                            <div>
                                                <label>Order Amount</label>
                                                @if($params->grand_total)
                                                    <span>{{ $params->grand_total }}</span>
                                                @else
                                                    <span>#NA</span>
                                                @endif
                                            </div>
                                        </div>
                                    <br>
                                @endforeach
                            @endif   
                        </div>                 
                </div>
        </div>
    </body>
</html>
