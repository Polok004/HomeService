@extends('loggedlayout')

@section('content')
<style>
    nav svg {
        height: 20px;
    }

    nav .hidden {
        display: block !important;
    }
</style>

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Service Requests</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Service Requests</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content-central">
    <div class="content_info">
        <div class="paddings-mini">
            <div class="container">
                <div class="row portfolioContainer">
                    <div class="col-md-12 profile1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        All Service Category
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                          
                                            <th>Service Category</th>
                                            <th>Customer Name</th>
                                            <th>Customer Address</th>
                                            <th>Customer Phone</th>
                                            
                                            <th>Price</th>
                                            <th>Action</th>
                                            <th>Confirm?</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{$booking->id}}</td>
                                           
                                            <td>{{$booking->service_category}}</td>
                                            <td>{{$booking->customer_name}}</td>
                                            <td>{{$booking->customer_location}}</td>
                                            <td>{{$booking->customer_phone}}</td>
                                          
                                            <td>{{$booking->service_price}}</td>

                                            <td>
                                            <a href="{{ route('operationDetails', ['id' => $booking->id]) }}">
    <i class="fa fa-info-circle fa-2x text-info"></i> <!-- Details icon -->
</a>

                                            </td>
                                            <td>
                                            @if($booking->featured)
    <span style="color: green;">Yes</span>
@else
    <span style="color: red;">No</span>
@endif

                                            </td>
                                            
                                  
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





@endsection