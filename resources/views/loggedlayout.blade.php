<!DOCTYPE html>
<html lang="en">
<x-header></x-header>

<body>
    <div id="layout">
        <div class="info-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="visible-md visible-lg text-left">
                            <li><a href="tel:+08801948405024"><i class="fa fa-phone"></i> +08801948405024</a></li>
                            <li><a href="mailto:polok2007004@gmail.com"><i class="fa fa-envelope"></i>
                                    polok2007004@gmail.com</a></li>
                        </ul>
                        <ul class="visible-xs visible-sm">
                            <li class="text-left"><a href="tel:+08801948405024"><i class="fa fa-phone"></i>
                                    +08801948405024</a></li>
                            <li class="text-right"><a href="/"><i
                                        class="fa fa-map-marker"></i> Teligati,Khulna</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="visible-md visible-lg text-right">
                           
                            <li><a href="/"><i class="fa fa-map-marker"></i> Teligati,Khulna
                                   </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <header id="header" class="header-v3" >
            <nav class="flat-mega-menu">
                <label for="mobile-button"> <i class="fa fa-bars"></i></label>
                <input id="mobile-button" type="checkbox">

                <ul class="collapse">
                    <li class="title">
                        <a href="/" ><img src="{{asset('images/rsz_1rsz_1rsz_1image_1 (1).png')}}" width="30" ></a>
                    </li>
                    <li> <a href="/" >Home </a>
                       
                       </li>
                    <li> <a href="{{route('ServiceCatagories')}}" >Our Services </a></li>
                   
                    
                    <li> <a href="{{route('contact')}}" >Contact Us</a>
                       
                    </li>
                    <li> <a href="{{route('about')}}" >About</a>
                       
                      
                    </li>
                  

  @if (Route::has('login'))
    @if (session()->has('user_id'))
    <li style="margin-right: 20px;" class="login-form">
        <a href="#" title="Register">{{ session('name') }} ( {{ session('user_type') }} ) </a>
        <ul class="drop-down one-column hover-fade">
            @if(session('user_type') == 'admin')
            <li><a href="{{ route('ownerProfile') }}">Profile</a></li>
            <li><a href="{{ route('dashboard') }}">Service Categories</a></li>
            <li><a href="{{ route('allServices') }}">All Services</a></li>
            <li><a href="{{ route('bookService') }}">My Work</a></li>
            <li><a href="{{ route('admin_slider') }}">Manage Slider</a></li>
            <li><a href="{{ route('messages') }}">My Messages</a></li>
            <li><a href="{{ route('SproviderDetails') }}">Service Providers</a></li>
            @elseif(session('user_type') == 'user')
            <li><a href="{{ route('user.profile') }}">Profile</a></li>
            <li><a href="{{ route('profile') }}">My bookings</a></li>
            @endif
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </li>
    @else
    <li class="login-form"> <a href="{{ route('register') }}" title="Register">Register</a></li>
    <li class="login-form"> <a href="{{ route('login') }}" title="Login">Login</a></li>
    @endif
@endif
                <li class="search-bar">
                    </li>
                </ul>
            </nav>
        </header>

      
            <div class="newcontainer" style="background-color: #0a3d62;margin-top: 10px;">
         
        

        @yield('content')


        <footer id="footer" class="footer-v1">
            <div class="container">
                <div class="row visible-md visible-lg">
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>APPLIANCE SERVICES </h3>
                        <ul>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'tv']) }}">TV</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'router']) }}">Router</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'refrigerator']) }}">Refrigerator</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'laundry']) }}">Washing Machine</a>
                            </li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'oven']) }}">Microwave Oven</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'shower-filter']) }}">Water Purifier</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>AC SERVICES </h3>
                        <ul>
                            <li><i class="fa fa-check"></i> <a
                                    href="{{ route('serviceDetails', ['service_slug' => 'ac-installation']) }}">Installation</a></li>
                            <li><i class="fa fa-check"></i> <a
                                    href="{{ route('serviceDetails', ['service_slug' => 'ac-unstallation']) }}">Uninstallation</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('serviceDetails', ['service_slug' => 'ac-repair']) }}">AC Repair</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('serviceDetails', ['service_slug' => 'gas-refil']) }}">Gas Refill</a>
                            </li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('serviceDetails', ['service_slug' => 'wet-servicing']) }}">Wet
                                    Servicing</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('serviceDetails', ['service_slug' => 'dry-servicing']) }}">Dry
                                    Servicing </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>HOME NEEDS </h3>
                        <ul>
                            <li><i class="fa fa-check"></i><a href="{{ route('ServiceByCatagories', ['category_slug' => 'laundry']) }}">Laundry</a></li>

                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'electricity']) }}">Electrical</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'pest-control']) }}">Pest Control </a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'carpentary']) }}">Carpentry </a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'plumbing']) }}">Plumbing </a></li>
                            <li><i class="fa fa-check"></i> <a href="{{ route('ServiceByCatagories', ['category_slug' => 'painting']) }}">Painting </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 col-sm-6">
                        <h3>CONTACT US</h3>
                        <ul class="contact_footer ">
                            <li class="location">
                                <i class="fa fa-map-marker"></i> <a href="#"> Teligati, Khulna, Bangladesh</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a
                                    href="mailto:polok2007004@gmail.com">polok2007004@gmail.com</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:+08801948405024">+08801948405024</a>
                            </li>
                        </ul>
                        <h3 style="margin-top: 10px">FOLLOW US</h3>
                        <ul class="social ">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="https://www.facebook.com/profile.php?id=100075370719738&mibextid=ZbWKwL"></a></li>
                            <li class="github"><span><i class="fa fa-github"></i></span><a href="https://github.com/Polok004"></a></li>
                            <li class="instagram"><span><i class="fa fa-instagram"></i></span><a href="https://www.instagram.com/shoumikbarman"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row visible-sm visible-xs">
                    <div class="col-md-6">
                        <h3 class="mlist-h">CONTACT US</h3>
                        <ul class="contact_footer mlist">
                            <li class="location">
                                <i class="fa fa-map-marker"></i> <a href="#"> Teligati, Khulna, Bangladesh</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a
                                    href="mailto:polok2007004@gmail.com">polok2007004@gmail.com</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:+08801948405024">+08801948405024</a>
                            </li>
                        </ul>
                        <ul class="social mlist-h">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="https://www.facebook.com/profile.php?id=100075370719738&mibextid=ZbWKwL"></a></li>
                            <li class="github"><span><i class="fa fa-github"></i></span><a href="https://github.com/Polok004"></a></li>
                            <li class="instagram"><span><i class="fa fa-instagram"></i></span><a href="https://www.instagram.com/shoumikbarman/"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-down">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="nav-footer">
                                <li><a href="{{route('about')}}">About Us</a> </li>
                                <li><a href="{{route('contact')}}">Contact Us</a></li>
                                <li><a href="/">FAQ</a></li>
                                <li><a href="/">Terms of Use</a></li>
                                <li><a href="/">Privacy</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="text-xs-center crtext">&copy; 2024 EliteHomeCare. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>                
            </div>            
        </footer>
    </div>
   <x-footer></x-footer>
  
</body>
</html>