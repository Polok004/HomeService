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
                                            <td>{{ $service->status ? 'Active' : 'Inactive' }}</td>
                                        </tr>
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
                                                @if(session()->has('user_id'))
                                                   @if(!$service->status)
                                                        <a href="{{ route('inactive') }}" class="btn btn-primary">Book Now</a>
                                                    @else
                                                <button type="button" class="btn btn-primary" onclick="toggleBookingForm()">Book Now</button>
                                                <div id="bookingForm" style="display: none;">
                                                <form id="payment-form" method="post" action="{{ route('save.booking') }}">
    @csrf
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Location">
    </div>
    <div class="form-group">
        <label for="card-element">Card</label>
        <div id="card-element" class="form-control"></div>
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" placeholder="Date">
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <input type="time" class="form-control" id="time" name="time" placeholder="Time">
    </div>
    <button type="submit" class="btn btn-primary">Book</button>
</form>

                                                </div>
                                                @endif  
                                                @else
                                                <a href="{{ route('login') }}" class="btn btn-primary">Login to Book</a>
                                                @endif
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
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    function toggleBookingForm() {
        var bookingForm = document.getElementById("bookingForm");
        bookingForm.style.display = bookingForm.style.display === "none" ? "block" : "none";
    }

    function setDateAndTimeRestrictions() {
        const today = new Date();
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        
        // Set minimum date to today
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months start from 0
        const dd = String(today.getDate()).padStart(2, '0');
        
        const minDate = `${yyyy}-${mm}-${dd}`;
        dateInput.setAttribute('min', minDate);

        // Event listener for date change to adjust the time input
        dateInput.addEventListener('change', function() {
            if (dateInput.value === minDate) {
                const hh = String(today.getHours()).padStart(2, '0');
                const min = String(today.getMinutes()).padStart(2, '0');
                const minTime = `${hh}:${min}`;
                timeInput.setAttribute('min', minTime);
            } else {
                timeInput.removeAttribute('min');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        setDateAndTimeRestrictions();
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        console.log('Form submitted');

        const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);

        if (error) {
            console.error('Payment Method Error:', error);
            document.getElementById('card-errors').textContent = error.message;
        } else {
            console.log('Payment Method Created:', paymentMethod);

            const response = await fetch('{{ route('create-payment-intent') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    payment_method: paymentMethod.id,
                    service_id: '{{ $service->id }}'
                }),
            });

            const paymentIntent = await response.json();
            console.log('Payment Intent Response:', paymentIntent);

            if (paymentIntent.error) {
                console.error('Payment Intent Error:', paymentIntent.error);
                document.getElementById('card-errors').textContent = paymentIntent.error;
            } else {
                const result = await stripe.confirmCardPayment(paymentIntent.client_secret, {
                    payment_method: paymentMethod.id,
                });
                console.log('Payment Confirmation Result:', result);

                if (result.error) {
                    console.error('Payment Confirmation Error:', result.error);
                    document.getElementById('card-errors').textContent = result.error.message;
                } else if (result.paymentIntent.status === 'succeeded') {
                    console.log('Payment Succeeded');
                    form.submit();
                }
            }
        }
    });
</script>


@endsection

