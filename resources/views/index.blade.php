@extends('loggedlayout')

@section('content')

<div>
    <section class="tp-banner-container" >
                <div class="tp-banner" >
                    <ul>
                        @foreach($slides as $slide)
                        <li data-transition="slidevertical" data-slotamount="1" data-masterspeed="1000"
                            data-saveperformance="off" data-title="Slide">
                            <img src="{{asset('images/Sliders')}}/{{ $slide->image }}" alt="{{ $slide->title }}" data-bgposition="center center"
                                data-kenburns="on" data-duration="6000" data-ease="Linear.easeNone" data-bgfit="130"
                                data-bgfitend="100" data-bgpositionend="right center">
                        </li>
                        @endforeach
                       
                    </ul>
                    <div class="tp-bannertimer"></div>
                </div>
                <div class="filter-title">
                    <div class="title-header">
                        <h2 style="color:#fff;">BOOK A SERVICE</h2>
                        <p class="lead">Book a service at very affordable price, </p>
                    </div>
                    <div class="filter-header">
                <form id="sform" action="{{ route('searchService') }}" method="post">
                    @csrf
                    <input type="text" id="q" name="q" required="required" placeholder="What Services do you want?" class="input-large typeahead" autocomplete="off">
                    <input type="submit" name="submit" value="Search">
                </form>
            </div>
                </div>
            </section>
            <section class="content-central">
                <div class="content_info content_resalt">
                    <div class="container" style="margin-top: 40px;">
                        <div class="row">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul id="sponsors" class="tooltip-hover">
                                @foreach($scatagories as $scatagory)
                                    <li data-toggle="tooltip" title="" data-original-title="{{$scatagory->name}}"> <a
                                            href="{{route('ServiceByCatagories',['category_slug' => $scatagory->slug])}}">
                                            <img src="{{asset('images/categories')}}/{{$scatagory->image}}"
                                                alt="{{$scatagory->name}}" width="60"></a></li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="semiboxshadow text-center">
                    <img src="{{asset('assets/img/img-theme/shp.png')}}" class="img-responsive" alt="">
                </div>
                <div class="content_info" >
                    <div>
                        <div class="container">
                            <div class="row">
                                <div class="titles">
                                    <h2>EliteHomeCare <span>Choice</span> of Services</h2>
                                    <i class="fa fa-plane"></i>
                                    <hr class="tall">
                                </div>
                            </div>
                            <div class="portfolioContainer" style="margin-top: -50px;">
                            @foreach($fservices as $service)
    @if($service->featured)
        <div class="col-xs-6 col-sm-4 col-md-3 hsgrids" style="padding-right: 5px;padding-left: 5px;">
            <a class="g-list" href="{{route('serviceDetails', ['service_slug' => $service->slug])}}">
                <div class="img-hover">
                    <img src="{{asset('images/services/thumbnails')}}/{{$service->thumbnail}}" alt="{{$service->name}}"
                        class="img-responsive" >
                </div>
                <div class="info-gallery">
                    <h3>{{$service->name}}</h3>
                    <hr class="separator">
                    <p>{{$service->tagline}}</p>
                    <div class="content-btn"><a href="{{route('serviceDetails', ['service_slug' => $service->slug])}}"
                            class="btn btn-primary">Book Now</a></div>
                    <div class="price"><span>&#36;</span><b>From</b>{{$service->price}}</div>
                </div>
            </a>
        </div>
    @endif
@endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="content_info">
                    <div class="bg-dark color-white border-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="services-lines-info">
                                        <h2>WELCOME TO DIVERSIFIED</h2>
                                        <p class="lead">
                                            Book best services at one place.
                                            <span class="line"></span>
                                        </p>
    
                                        <p>Find a wide variety of home services.</p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <ul class="services-lines">
                                        @foreach($fscatagories as $fscatagory)
                                        <li>
                                            <a href="{{route('ServiceByCatagories',['category_slug' => $fscatagory->slug])}}">
                                                <div class="item-service-line">
                                                    <i class="fa"><img class="icon-img"
                                                            src="{{asset('images/categories')}}/{{$fscatagory->image}}" alt="{{($fscatagory->name)}}" width="60"></i>
                                                    <h5>{{$fscatagory->name}}</h5>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="titles">
                                <h2><span>Appliance</span>Services</h2>
                                <i class="fa fa-plane"></i>
                                <hr class="tall">
                            </div>
                        </div>
                    </div>
                    <div id="boxes-carousel">
                        @foreach($aservices as $aservice)
                        <div>
                            <a class="g-list" href="{{route('serviceDetails', ['service_slug' => $aservice->slug])}}">
                                <div class="img-hover">
                                    <img src="{{asset('images/services/thumbnails')}}/{{$aservice->thumbnail}}" alt="{{$aservice->name}}" class="img-responsive" >
                                </div>
    
                                <div class="info-gallery">
                                    <h3>{{$aservice->name}}</h3>
                                    <hr class="separator">
                                    <p>{{$aservice->tagline}}g</p>
                                    <div class="content-btn"><a href="{{route('serviceDetails', ['service_slug' => $aservice->slug])}}"
                                            class="btn btn-primary">Book Now</a></div>
                                    <div class="price"><span>&#36;</span><b>From</b>{{$aservice->price}}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                       
                    </div>
                </div>
            </section>
    </div>
    




@endsection