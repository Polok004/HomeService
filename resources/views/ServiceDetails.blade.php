@extends('loggedlayout')

@section('content')
<div class="section-title-01 honmob">
    <div class="bg_parallax image_01_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>{{$service->name}}</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>{{$service->name}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="content-central">
    <div class="semiboxshadow text-center">
        <img src="img/img-theme/shp.png" class="img-responsive" alt="">
    </div>
    <div class="content_info">
        <div class="paddings-mini">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 single-blog">
                        <div class="post-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="post-header">
                                        <div class="post-format-icon post-format-standard" style="margin-top: -10px;">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <div class="post-info-wrap">
                                            <h2 class="post-title">
                                                <a href="#" title="Post Format: Standard" rel="bookmark">{{$service->name}}: {{$service->category_name}}</a>
                                            </h2>
                                            <div class="post-meta" style="height: 10px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="single-carousel">
                                        <div class="img-hover">
                                            <img src="{{ asset('images/services')}}/{{$service->image}}" class="img-responsive" alt="{{$service->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-content">
                                        <h3>{{$service->name}}</h3>
                                        <p>{{$service->description}}</p>
                                        <h4>Inclusion</h4>
                                        
                                        <ul class="list-styles">
                                            @foreach(explode("|",$service->inclusion) as $inclusion)
                                                <li><i class="fa fa-plus"></i>{{$inclusion}}</li>
                                            @endforeach
                                        </ul>
                                        <h4>Exclusion</h4>
                                        <ul class="list-styles">
                                            @foreach(explode("|",$service->exclusion) as $exclusion)
                                                <li><i class="fa fa-plus"></i>{{$exclusion}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <aside class="widget" style="margin-top: 18px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Booking Details</div>
                                <div class="panel-body" id="bookingDetails">
                                    <table class="table" id="bookingTable">
                                        <tr>
                                            <td style="border-top: none;">Price</td>
                                            <td style="border-top: none;"><span>&#36;</span> {{$service->price}}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                        
                                            <td>Status</td>
                                            @if($service->status)
                                            <td > Active</td>
                                            @else
                                            <td > Inactive</td>
                                            @endif
                                        </tr>
                                        <tr>
                                        @php
                                            $total = $service->price;
                                        @endphp
                                        @if($service->discount)
                                            @if($service->discount_type=='fixed')
                                        <tr>
                                            <td>Discount</td>
                                            <td>${{$service->discount}}</td>
                                        </tr>
                                        @php
                                            $total -= $service->discount;
                                        @endphp
                                        @elseif($service->discount_type=='percent')
                                        <tr>
                                            <td>Discount</td>
                                            <td>${{$service->discount}}%</td>
                                            @php
                                            $total -= ($total * $service->discount / 100);
                                        @endphp
                                        </tr>
                                        @endif
                                        @endif
                                        <tr>
                                            <td>Total</td>
                                            <td><span>&#36;</span> {{$total}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                @auth
                                                <button type="button" class="btn btn-primary" onclick="toggleBookingForm()">Book Now</button>
                                                <div id="bookingForm" style="display: none;">
                                                    <form class="px-4 py-3" id="bookingForm"  method="post" action="{{ route('save.booking') }}" enctype="multipart/form-data">

                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="location">Location</label>
                                                            <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                                                        </div>
                                                        <div class="form-group">
    <label for="cardNumber">Card Number</label>
    <div id="cardNumber" class="form-control"></div>
    <input type="text" id="cardNumberInput" class="form-control" placeholder="Enter card number">
</div>
<div class="form-group">
    <label for="cardExpiry">Expiration Date</label>
    <div id="cardExpiry" class="form-control"></div>
    <input type="text" id="cardExpiryInput" class="form-control" placeholder="MM/YY">
</div>
<div class="form-group">
    <label for="cardCvc">CVC</label>
    <div id="cardCvc" class="form-control"></div>
    <input type="text" id="cardCvcInput" class="form-control" placeholder="Enter CVC">
</div>

                                                        <div class="form-group">
                                                            <label for="date">Date</label>
                                                            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">Time</label>
                                                            <input type="time" class="form-control" id="time" name="time" placeholder="Time">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" >Book</button>
                                                        
                                                    </form>
                                                </div>
                                                @else
                                                <a href="{{ route('login') }}" class="btn btn-primary">Login to Book</a>
                                                @endauth
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </aside>
                        <aside>
                            @if($r_service)
                            <h3>Related Service</h3>
                            <div class="col-md-12 col-sm-6 col-xs-12 bg-dark color-white padding-top-mini" style="max-width: 360px">
                                <a href="{{route('serviceDetails',['service_slug'=> $r_service->slug])}}">
                                    <div class="img-hover">
                                        <img src="{{ asset('images/services/thumbnails')}}/{{$r_service->thumbnail}}" class="img-responsive" alt="{{$r_service->name}}">
                                    </div>
                                    <div class="info-gallery">
                                        <h3>{{$r_service->name}}</h3>
                                        <hr class="separator">
                                        <p>{{$r_service->name}}</p>
                                        <div class="content-btn">
                                            <a href="{{route('serviceDetails',['service_slug'=> $r_service->slug])}}" class="btn btn-warning">View Details</a>
                                        </div>
                                        <div class="price"><span>&#36;</span><b>From</b>{{$r_service->price}}</div>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</section>


<script>
    var stripe = Stripe('pk_test_51PG0bY0442N1k1LoZNX2HRHy5Kos8UW6qmrhCTqs5UnsyaRBD3i96hcP5GPIGDBGeqUIpCNwZxY3PYqkyEHPpZ0u00X7h8OZel');
    var elements = stripe.elements();

var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

var cardNumber = elements.create('cardNumber', {
    style: style,
    placeholder: 'Enter card number'
});
cardNumber.mount('#cardNumber');

var cardExpiry = elements.create('cardExpiry', {
    style: style,
    placeholder: 'MM/YY'
});
cardExpiry.mount('#cardExpiry');

var cardCvc = elements.create('cardCvc', {
    style: style,
    placeholder: 'Enter CVC'
});
cardCvc.mount('#cardCvc');

function toggleBookingForm() {
    var bookingForm = document.getElementById("bookingForm");
    if (bookingForm.style.display === "none") {
        bookingForm.style.display = "block";
    } else {
        bookingForm.style.display = "none";
    }
}

document.getElementById('stripeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(cardNumber).then(function(result) {
        if (result.error) {
            console.error(result.error.message);
        } else {
            if (result.token.card.brand === 'Visa') {
                stripeTokenHandler(result.token);
            } else {
                console.error('Only Visa cards are accepted.');
            }
        }
    });
});

function stripeTokenHandler(token) {
    var form = document.getElementById('stripeForm');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
}
</script>







@endsection

