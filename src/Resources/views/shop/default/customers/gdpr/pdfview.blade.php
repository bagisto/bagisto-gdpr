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
                                <table>
                                    <tr>
                                        <td>First Name</td>
                                        @if($param['customerInformation']->first_name)
                                            <td>{{ $param['customerInformation']->first_name }}</td>
                                        @else
                                            <td>#NA</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        @if($param['customerInformation']->last_name)
                                            <td>{{ $param['customerInformation']->last_name }}</td>
                                        @else
                                            <td>#NA</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        @if($param['customerInformation']->email)
                                            <td>{{ $param['customerInformation']->email }}</td>
                                        @else
                                            <td>#NA</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        @if($param['customerInformation']->gender)
                                            <td>{{ $param['customerInformation']->gender }}</td>
                                        @else
                                            <td>#NA</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        @if($param['customerInformation']->date_of_birth)
                                            <td>{{ $param['customerInformation']->date_of_birth }}</td>
                                        @else
                                            <td>#NA</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        @if($param['customerInformation']->phone)
                                            <td>{{ $param['customerInformation']->phone }}</td>
                                        @else
                                            <td>#NA</td>
                                        @endif
                                    </tr>
                                </table>
                            <br>
                        </div>                  
    
                    <h2> Address Information</h2>
                        <div class="table address">
                            @if(isset($param['address']))
                                @foreach($param['address'] as $params)
                                    <br>
                                        <table>
                                            <th class="heading">Address - {{$params->id}}</th>
                                            <tr>
                                                <td>City</td>
                                                @if($params->city)
                                                    <td>{{ $params->city }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Company</td>
                                                @if($params->company_name)
                                                    <td>{{ $params->company_name }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Country</td>
                                                @if($params->country)
                                                    <td>{{ core()->country_name($params->country) }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>First Name</td>
                                                @if($params->first_name)
                                                    <td>{{ $params->first_name }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Last name</td>
                                                @if($params->last_name)
                                                    <td>{{ $params->last_name }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                @if($params->phone)
                                                    <td>{{ $params->phone }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                        </table>
                                    <br>
                                 @endforeach
                            @endif   
                        </div> 

                    <h2> Order Information</h2>
                        <div class="table address">
                            @if(isset($param['order']))
                                @foreach($param['order'] as $params)
                                    <br>
                                        <table>
                                            <th class="heading" align="left">Order - {{$params->id}}</th>
                                            <tr>
                                                <td>Order ID</td>
                                                @if($params->id)
                                                    <td>{{ $params->id }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                @if($params->status)
                                                    <td>{{ $params->status }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                @if($params->shipping_title)
                                                    <td>{{ $params->shipping_title }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Customer First Name</td>
                                                @if($params->customer_first_name)
                                                    <td>{{ $params->customer_first_name }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Customer Last Name</td>
                                                @if($params->customer_last_name)
                                                    <td>{{ $params->customer_last_name }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Customer Company Name</td>
                                                @if($params->customer_company_name)
                                                    <td>{{ $params->customer_company_name }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Order Quantity</td>
                                                @if($params->total_qty_ordered)
                                                    <td>{{ $params->total_qty_ordered }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Order Amount</td>
                                                @if($params->grand_total)
                                                    <td>{{ $params->grand_total }}</td>
                                                @else
                                                    <td>#NA</td>
                                                @endif
                                            </tr>
                                        </table>
                                    <br>
                                @endforeach
                            @endif   
                        </div>                 
                </div>
        </div>
    </body>
</html>
