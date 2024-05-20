@extends('loggedlayout')

@section('content')

@if($scategory)
<div class="section-title-01 honmob">
    <div class="bg_parallax image_01_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>{{$scategory->name}} Services</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>/</li>
                    <li>{{$scategory->name}} </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="content-central">
    <div class="container">
        <div class="row" style="margin-top: -30px;">
            <div class="titles">
                <h2>{{$scategory->name}} <span>Services</span></h2>
                <i class="fa fa-plane"></i>
                <hr class="tall">
            </div>
        </div>
    </div>
    <div class="content_info" style="margin-top: -70px;">
        <div>
            <div class="container">
                <div class="portfolioContainer">
                    @if($services->isNotEmpty())
                        @foreach($services as $service)
                        <div class="col-xs-6 col-sm-4 col-md-3 nature hsgrids" style="padding-right: 5px;padding-left: 5px;">
                            <a class="g-list" href="{{ route('serviceDetails', ['service_slug' => $service->slug]) }}">
                                <div class="img-hover">
                                    <img src="{{ asset('images/services/thumbnails')}}/{{$service->thumbnail}}" alt="{{$service->name}}" class="img-responsive">
                                </div>
                                <div class="info-gallery">
                                    <h3>{{$service->name}}</h3>
                                    <hr class="separator">
                                    <p>{{$service->tagline}}</p>
                                    <div class="content-btn">
                                        <a href="{{ route('serviceDetails', ['service_slug' => $service->slug]) }}" class="btn btn-warning">View Details</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <p>No services found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>            
</section>
@else
<div class="container">
    <p>Category not found!</p>
</div>
@endif

@endsection
