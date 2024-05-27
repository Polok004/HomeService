@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Edit Service Requests</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Edit Service Requests</li>
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
                    <div class="col-md-8 col-md-offset-2 profile1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        Edit Service Requests
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('bookService')}}" class="btn btn-info pull-right">All Service Requests</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form class="form-horizontal" method="POST" action="{{ route('updateService', $bookings->id) }}" enctype="multipart/form-data">

                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $bookings->id }}">
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Customer name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $bookings->customer_name }}" disabled>
                                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Customer ID:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->user_id }}" disabled>
                                            @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Customer Phone:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->customer_phone }}" disabled>
                                            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Home Address:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->customer_location }}" disabled>
                                            @error('customer_location') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Customer Card No:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->customer_cardNo }}" disabled>
                                            @error('customer_cardNo') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Service Date:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->customer_date }}" disabled>
                                            @error('customer_date') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Service Time:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->customer_time }}" disabled>
                                            @error('customer_time') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Service ID:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->service_id }}" disabled>
                                            @error('service_id') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3"> Service Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->service_name }}" disabled>
                                            @error('service_name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Category:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->service_category }}" disabled>
                                            @error('service_category') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Service Price:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->service_price }}"disabled>
                                            @error('service_price') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-sm-3">Customer Address:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="id" id="id" value="{{ $bookings->user_id }}" disabled>
                                            @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="category" class="control-label col-sm-3">Service Provider:</label>
                                          <div class="col-sm-9">
                                            <select name="category" id="category" class="form-control">
                                             @if($bookings->sprovider)
                                                <option value="{{ $bookings->sprovider }}">{{ $bookings->sprovider }}</option>
                                               @else
                                                 <option value="">Select a service provider</option> <!-- Add an empty default option -->
                                             @endif
                                         @foreach($sprovider as $provider)
                                         @if($provider->Service_Catagory == $bookings->service_category)
                    <option value="{{ $provider->name }}">{{ $provider->name }}</option>
                @endif
            @endforeach
        </select>
        @error('category') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>



                                    




                                    
                                    <button type="submit" class="btn btn-success pull-right">Update Service</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
