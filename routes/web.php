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



Route::get('/', [AuthController::class, 'index']);

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::POST('register', [AuthController::class, 'registerSave'])->name('register.save');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::POST('login', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('ServiceCatagories', [ServiceCatagoryController::class, 'Service'])->name('ServiceCatagories');
Route::get('/service-catagories', [ServiceCatagoryController::class, 'Service']);
Route::get('/service-by-catagories/{category_slug}', [ServiceCatagoryController::class, 'CatagoryBy'])->name('ServiceByCatagories');
Route::get('/serviceDetails/{service_slug}', [ServiceDetails::class, 'index'])->name('serviceDetails');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/searchService', [SearchController::class, 'searchService'])->name('searchService');

Route::get('/contact', [contactController::class, 'index'])->name('contact');
Route::post('/contact', [contactController::class, 'sendContactMail'])->name('sendContactMail');
Route::get('/messages', [contactController::class, 'allMessages'])->name('messages');
Route::get('/Sproviderprofile/{id}', [SproviderController::class, 'showSprovider'])->name('Sproviderprofile');
Route::get('/about', [SearchController::class, 'index'])->name('about');
//user
Route::group(['middleware'=>'user'],function (){

Route::get('/home1', [home1controller::class, 'index'])->name('home1');
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
Route::get('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('cancelBooking');


});

//admin
Route::group(['middleware'=>'admin'],function () {
  
    Route::get('/owner', [ProfileController::class, 'ownerProfile'])->name('ownerProfile');
    Route::get('/bookedService', [ProfileController::class, 'booked'])->name('bookService');
    Route::get('/dashboard', [home1controller::class, 'adminHome'])->name('dashboard');
    Route::get('/addService', [home1controller::class, 'addServe'])->name('addService');
    Route::post('/new-category', [adminController::class, 'newCategory'])->name('newCategory');
    Route::get('/edit-service/{category_id}', [adminController::class, 'editCategory'])->name('editService');
    Route::post('/editService', [adminController::class, 'updateCategory'])->name('updateCategory');
    Route::get('/deleteCategory/{category_id}', [adminController::class, 'deleteCategory'])->name('deleteCategory');
    Route::get('/services', [ServiceCatagoryController::class, 'allServices'])->name('allServices');
    Route::get('/add AllService', [ServiceController::class, 'addNewServe'])->name('add AllService');
    Route::post('/new-service', [ServiceController::class, 'storeNewService'])->name('newService');
// Route for updating the service
    Route::get('/editAllServices/{service_id}', [ServiceController::class, 'editAllService'])->name('editAllService');
    
    Route::post('/editAllServices', [ServiceController::class, 'updateService'])->name('updateAllService');
    Route::get('/deleteService/{service_id}', [ServiceController::class, 'deleteService'])->name('deleteService');
   
    // Route to save booking
    Route::get('/admin_slider', [SliderController::class, 'index'])->name('admin_slider');
    

    Route::get('/addSlider', [SliderController::class, 'addNewSlider'])->name('addSlider');
    Route::post('/new-slider', [SliderController::class, 'storeNewSlider'])->name('newSlider');

    Route::get('/edit-slide/{id}', [SliderController::class, 'editSlider'])->name('editSlide');
Route::post('/update-slider', [SliderController::class, 'updateSlider'])->name('updateSlider');

Route::get('/delete-slider/{id}', [SliderController::class, 'deleteSlider'])->name('deleteSlider');


Route::get('/SproviderDetails', [SproviderController::class, 'index'])->name('SproviderDetails');


// Route to display the form for adding a new service provider
Route::get('/addSproviders', [SproviderController::class, 'addNewSprovider'])->name('addSproviders');

// Route to store the new service provider data
Route::post('/storeSprovider', [SproviderController::class, 'storeNewSprovider'])->name('storeSprovider');


// Route for displaying the form to edit a service provider
Route::get('/edit-sproviders/{id}', [SproviderController::class, 'editSprovider'])->name('editSproviders');

// Route for updating a service provider
Route::post('/update-sprovider', [SproviderController::class, 'updateSprovider'])->name('updateSprovider');

Route::get('/delete-sprovider/{id}', [SproviderController::class, 'deleteSprovider'])->name('deleteSprovider');



Route::get('/operationDetails/{id}', [ProfileController::class, 'showDetails'])->name('operationDetails');
Route::post('/operationDetails/{id}/update', [ProfileController::class, 'updateService'])->name('updateService');
   
});