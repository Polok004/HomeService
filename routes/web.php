<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\home1controller;
use App\Http\Controllers\ServiceCatagoryController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceDetails;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\SproviderController;


//index routes
Route::get('/', [AuthController::class, 'index']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::POST('register', [AuthController::class, 'registerSave'])->name('register.save');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::POST('login', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//end index routes

Route::get('ServiceCatagories', [ServiceCatagoryController::class, 'Service'])->name('ServiceCatagories');
Route::get('/service-catagories', [ServiceCatagoryController::class, 'Service']);
Route::get('/service-by-catagories/{category_slug}', [ServiceCatagoryController::class, 'CatagoryBy'])->name('ServiceByCatagories');
Route::get('/serviceDetails/{service_slug}', [ServiceDetails::class, 'index'])->name('serviceDetails');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/searchService', [SearchController::class, 'searchService'])->name('searchService');

Route::get('/contact', [contactController::class, 'index'])->name('contact');
Route::post('/contact', [contactController::class, 'sendContactMail'])->name('sendContactMail');

Route::get('/Sproviderprofile/{id}', [SproviderController::class, 'showSprovider'])->name('Sproviderprofile');
Route::get('/about', [SearchController::class, 'index'])->name('about');
//user

Route::group(['middleware'=>'user'],function (){


Route::post('/create-payment-intent', [BookingController::class, 'createPaymentIntent'])->name('create-payment-intent');

Route::post('/save-booking', [BookingController::class, 'saveBooking'])->name('save.booking');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

Route::get('/inactive', function () {
    return view('inactive');
})->name('inactive');

Route::get('/user/profile', [ProfileController::class, 'userProfile'])->name('user.profile');
Route::get('inactive', [BookingController::class, 'inactive'])->name('inactive');
Route::get('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('cancelBooking');
});

//admin
Route::group(['middleware'=>'admin'],function () {
  
    Route::get('/owner', [ProfileController::class, 'ownerProfile'])->name('ownerProfile');
    Route::get('/bookedService', [ProfileController::class, 'booked'])->name('bookService');
//Service Categories
    //category showss
    Route::get('/dashboard', [home1controller::class, 'adminHome'])->name('dashboard');
    //new category add page
    Route::get('/addService', [home1controller::class, 'addServe'])->name('addService');
    //new category add function page
    Route::post('/new-category', [adminController::class, 'newCategory'])->name('newCategory');
    //edit category blade
    Route::get('/edit-service/{category_id}', [adminController::class, 'editCategory'])->name('editService');
    //edit category 
    Route::post('/editService', [adminController::class, 'updateCategory'])->name('updateCategory');
    //delete category
    Route::get('/deleteCategory/{category_id}', [adminController::class, 'deleteCategory'])->name('deleteCategory');
//category end

//service start
    //all service page
    Route::get('/services', [ServiceCatagoryController::class, 'allServices'])->name('allServices');
    //add service blade
    Route::get('/add AllService', [ServiceController::class, 'addNewServe'])->name('add AllService');
    //add service 
    Route::post('/new-service', [ServiceController::class, 'storeNewService'])->name('newService');
    //edit service blade
    Route::get('/editAllServices/{service_id}', [ServiceController::class, 'editAllService'])->name('editAllService');
    //edit service
    Route::post('/editAllServices', [ServiceController::class, 'updateService'])->name('updateAllService');
    //delete service
    Route::get('/deleteService/{service_id}', [ServiceController::class, 'deleteService'])->name('deleteService');
//service ends
//slider
    //sliderpage
    Route::get('/admin_slider', [SliderController::class, 'index'])->name('admin_slider');
    //add slider blade
    Route::get('/addSlider', [SliderController::class, 'addNewSlider'])->name('addSlider');
    //add slider
    Route::post('/new-slider', [SliderController::class, 'storeNewSlider'])->name('newSlider');
    //edit slider blade
    Route::get('/edit-slide/{id}', [SliderController::class, 'editSlider'])->name('editSlide');
    //edit slider
      Route::post('/update-slider', [SliderController::class, 'updateSlider'])->name('updateSlider');
    //delete slider
     Route::get('/delete-slider/{id}', [SliderController::class, 'deleteSlider'])->name('deleteSlider');
//slider ends

//sprovider 
    //sprovider page
Route::get('/SproviderDetails', [SproviderController::class, 'index'])->name('SproviderDetails');
    //add sprovider blade
Route::get('/addSproviders', [SproviderController::class, 'addNewSprovider'])->name('addSproviders');
    //add sprovider
Route::post('/storeSprovider', [SproviderController::class, 'storeNewSprovider'])->name('storeSprovider');
    //edit sprovider blade
Route::get('/edit-sproviders/{id}', [SproviderController::class, 'editSprovider'])->name('editSproviders');
    //edit sprovider
Route::post('/update-sprovider', [SproviderController::class, 'updateSprovider'])->name('updateSprovider');
    //delete sprovider
Route::get('/delete-sprovider/{id}', [SproviderController::class, 'deleteSprovider'])->name('deleteSprovider');
//sprovider ends

//booking
    //booking page
Route::get('/operationDetails/{id}', [ProfileController::class, 'showDetails'])->name('operationDetails');
    //update booking
Route::post('/operationDetails/{id}/update', [ProfileController::class, 'updateService'])->name('updateService');

//booking ends

//contact
Route::get('/messages', [contactController::class, 'allMessages'])->name('messages');
});