@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Profile</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Profile</li>
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
                                    <div class="col-md-6" style="center">
                                        {{ session('name') }}'s Profile
                                    </div>
                                    <div class="col-md-6">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/man-303792_1920.png') }}" width="100%">
                                    </div>    
                                    <div class="col-md-8" style="border-left: 5px dotted #ccc;">
                                        <h3><b>Name:</b> {{ session('name') }}</h3>
                                        <h3><b>Email:</b> {{ session('email') }}</h3>
                                        <h3><b>Phone:</b> {{ session('phone') }}</h3>
                                        <h3><b>Service Taken:</b> {{ $totalServicesTaken }}</h3>
                                        <h3><b>Customer Type:</b> {{ $customerType }}</h3>
                                    </div>
                                </div>
                                <div class="dotted-line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
