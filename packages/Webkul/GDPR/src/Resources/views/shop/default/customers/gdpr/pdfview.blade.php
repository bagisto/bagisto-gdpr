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
</style>

    </head>

    <body style="background-image: none;background-color: #fff;">
        <div class="container">
            <h1 class="hcol">Default Store View</h1>
                <div class="invoice-summary">
                    <h2> Account Information </h2>
                        <div class="table address">
                            <table>
		                        <tr>
			                        <td>First Name</td>
                                    @if($params['customerInformation']->first_name)
                                        <td>{{ $params['customerInformation']->first_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Last Name</td>
                                    @if($params['customerInformation']->last_name)
                                        <td>{{ $params['customerInformation']->last_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Email</td>
                                    @if($params['customerInformation']->email)
                                        <td>{{ $params['customerInformation']->email }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Gender</td>
                                    @if($params['customerInformation']->gender)
                                        <td>{{ $params['customerInformation']->gender }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Date Of Birth</td>
                                    @if($params['customerInformation']->date_of_birth)
                                        <td>{{ $params['customerInformation']->date_of_birth }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Phone</td>
                                    @if($params['customerInformation']->phone)
                                        <td>{{ $params['customerInformation']->phone }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
	                        </table>
                        </div>                  
    
                    <h2> Address Information</h2>
                        <div class="table address">
                            @if(isset($params['address']))
                            <table>
		                        <tr>
			                        <td>City</td>
                                    @if($params['address']->city)
                                        <td>{{ $params['address']->city }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Company</td>
                                    @if($params['address']->company)
                                        <td>{{ $params['address']->company }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Country</td>
                                    @if($params['address']->country)
                                        <td>{{ core()->country_name($params['address']->country) }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>First Name</td>
                                    @if($params['address']->first_name)
                                        <td>{{ $params['address']->first_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Last name</td>
                                    @if($params['address']->last_name)
                                        <td>{{ $params['address']->last_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Phone</td>
                                    @if($params['address']->phone)
                                        <td>{{ $params['address']->phone }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
	                        </table>
                            @endif   
                        </div> 

                    <h2> Order Information</h2>
                        <div class="table address">
                            @if(isset($params['order']))
                            <table>
		                        <tr>
			                        <td>Order ID</td>
                                    @if($params['order']->id)
                                        <td>{{ $params['order']->id }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Status</td>
                                    @if($params['order']->status)
                                        <td>{{ $params['order']->status }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Shipping</td>
                                    @if($params['order']->shipping_title)
                                        <td>{{ $params['order']->shipping_title }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Customer First Name</td>
                                    @if($params['order']->customer_first_name)
                                        <td>{{ $params['order']->customer_first_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Customer Last Name</td>
                                    @if($params['order']->customer_last_name)
                                        <td>{{ $params['order']->customer_last_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Customer Company Name</td>
                                    @if($params['order']->customer_company_name)
                                        <td>{{ $params['order']->customer_company_name }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Order Quantity</td>
                                    @if($params['order']->total_qty_ordered)
                                        <td>{{ $params['order']->total_qty_ordered }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
                                <tr>
			                        <td>Order Amount</td>
                                    @if($params['order']->grand_total)
                                        <td>{{ $params['order']->grand_total }}</td>
                                    @else
                                        <td>#NA</td>
                                    @endif
                                </tr>
	                        </table>
                            @endif   
                        </div>                 
                </div>
        </div>
    </body>
</html>
