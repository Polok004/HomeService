@extends('loggedlayout')

@section('content')

<div class="section-title-01 honmob">
    <div class="bg_parallax image_02_parallax"></div>
    <div class="opacy_bg_02">
        <div class="container">
            <h1>Contact Us</h1>
            <div class="crumbs">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/</li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="content-central">

    <div class="content_info">
        <div class="paddings-mini">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <aside>
                            <h4>The Office</h4>
                            <address>
                                <strong>Elite Home Care.</strong><br>
                                <i class="fa fa-map-marker"></i><strong>Address: </strong>Teligati, Khulna
                                <br>
                                <i class="fa fa-phone"></i><strong>Phone: </strong> +088 123 456 789<br>
                            </address>
                            <address>
                                <strong>Elite Home Care Emails</strong><br>
                                <i class="fa fa-envelope"></i><strong>Email:</strong><a href="mailto:polok2007004@gmail.com">polok2007004@gmail.com</a><br>
                                <i class="fa fa-envelope"></i><strong>Email:</strong><a href="mailto:shoumik87@gmail.com">shoumik87@gmail.com</a>
                            </address>
                        </aside>
                        <hr class="tall">
                    </div>
                    <div class="col-md-8">
                        <h3>Contact Form</h3>
                        <p class="lead"></p>
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form id="contactform" class="form-theme" method="post" action="{{ route('sendContactMail') }}">
                            @csrf
                            <input type="text" placeholder="Name" name="name" id="name" required="">
                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror 
                            <input type="email" placeholder="Email" name="email" id="email" required="">
                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror 
                            <input type="text" placeholder="Phone" name="phone" id="phone" required="">
                            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror 
                            <input type="text" placeholder="Location" name="location" id="autocomplete" required="">
                            @error('location') <p class="text-danger">{{ $message }}</p> @enderror 
                            <textarea placeholder="Your Message" name="message" id="message" required=""></textarea>
                            @error('message') <p class="text-danger">{{ $message }}</p> @enderror 
                            <input type="submit" name="Submit" value="Send Message" class="btn btn-primary">
                        </form>
                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-twitter content_resalt border-top"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
