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
            <h1>Service Categories</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Service Categories</li>
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
                                        <a href="{{ route('ServiceCatagories') }}" class="btn btn-info pull-right">Add new</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Category</th>
                                            <th>Service Name</th>
                                            <th>Date</th>
                                            <th>Service Time</th>
                                            <th>Price</th>
                                            <th>Service Provider</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                            @if(Auth::user() && Auth::user()->id == $booking->user_id)
                                                <tr>
                                                    <td>{{ $booking->id }}</td>
                                                    <td>{{ $booking->service_category }}</td>
                                                    <td>{{ $booking->service_name }}</td>
                                                    <td>{{ $booking->customer_date }}</td>
                                                    <td>{{ $booking->customer_time }}</td>
                                                    <td>{{ $booking->service_price }}</td>
                                                    <td>
                                                        @if($booking->featured)
                                                            <a href="{{ route('Sproviderprofile', ['id' => $booking->service_provider_id]) }}">
                                                                <i class="fa fa-user fa-2x text-primary"></i>
                                                            </a>
                                                        @else
                                                            <span class="text-warning">pending</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
