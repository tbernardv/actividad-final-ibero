<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Pages
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'foods'], function () {
    // Rutas dentro del grupo 'foods'
    Route::get('/foods/food-details/{id}', [App\Http\Controllers\FoodsController::class, 'foodDetails'])->name('food-details');

    //Cart
    Route::post('/food-details/{id}', [App\Http\Controllers\FoodsController::class, 'cart'])->name('food-cart');
    Route::get('/cart', [App\Http\Controllers\FoodsController::class, 'displayCartItems'])->name('food-display-cart');
    Route::get('/delete-cart/{id}', [App\Http\Controllers\FoodsController::class, 'deleteCartItems'])->name('food-delete-cart');

    // Checkout
    Route::post('/food-checkout', [App\Http\Controllers\FoodsController::class, 'prepareCheckout'])->name('prepare-checkout');
    Route::get('/checkout', [App\Http\Controllers\FoodsController::class, 'checkout'])->name('food-checkout');
    Route::post('/checkout', [App\Http\Controllers\FoodsController::class, 'storeCheckout'])->name('food-checkout-store');

    //Pay with Paypal
    Route::get('/pay', [App\Http\Controllers\FoodsController::class, 'paypalPay'])->name('foods-pay');
    Route::get('/success', [App\Http\Controllers\FoodsController::class, 'success'])->name('foods-success');

    //Booking tables
    Route::post('/booking', [App\Http\Controllers\FoodsController::class, 'bookingTables'])->name('food-booking-tables');

    //Menu
    Route::get('/menu', [App\Http\Controllers\FoodsController::class, 'menu'])->name('foods-menu');
});

Route::group(['prefix' => 'users'], function () {
    //Rutas dentro del grupo 'users'

    //Users
    Route::get('/bookings', [App\Http\Controllers\usersController::class, 'getBookings'])->name('users-bookings');
    Route::get('/orders', [App\Http\Controllers\usersController::class, 'getOrders'])->name('users-orders');

    //Reviews
    Route::get('/write-reviews', [App\Http\Controllers\usersController::class, 'viewReviewsFrm'])->name('users-reviews-create');
    Route::post('/write-reviews', [App\Http\Controllers\usersController::class, 'storeReview'])->name('users-reviews-store');
});

// Admin
Route::get('/admin/login', [App\Http\Controllers\AdminsController::class, 'viewLogin'])->name('view-login')->middleware('checkforauth');
Route::post('/admin/login', [App\Http\Controllers\AdminsController::class, 'checkLogin'])->name('check-login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/index', [App\Http\Controllers\AdminsController::class, 'index'])->name('admins-dashboard');

    Route::get('/all-admins', [App\Http\Controllers\AdminsController::class, 'allAdmins'])->name('admins-all');
    Route::get('/admins-create', [App\Http\Controllers\AdminsController::class, 'createAdmins'])->name('admins-create');
    Route::post('/admins-store', [App\Http\Controllers\AdminsController::class, 'storeAdmins'])->name('admins-store');

    // Orders
    Route::get('/all-orders', [App\Http\Controllers\AdminsController::class, 'allOrders'])->name('orders-all');
    Route::get('/edit-orders/{id}', [App\Http\Controllers\AdminsController::class, 'editOrders'])->name('orders-edit');
    Route::post('/edit-orders/{id}', [App\Http\Controllers\AdminsController::class, 'updateOrders'])->name('orders-update');
    Route::get('/delete-orders/{id}', [App\Http\Controllers\AdminsController::class, 'deleteOrders'])->name('orders-delete');

    // Bookings
    Route::get('/all-bookings', [App\Http\Controllers\AdminsController::class, 'allBookings'])->name('bookings-all');
    Route::get('/edit-bookings/{id}', [App\Http\Controllers\AdminsController::class, 'editBookings'])->name('bookings-edit');
    Route::post('/edit-bookings/{id}', [App\Http\Controllers\AdminsController::class, 'updateBookings'])->name('bookings-update');
    Route::get('/delete-bookings/{id}', [App\Http\Controllers\AdminsController::class, 'deleteBookings'])->name('bookings-delete');

    // Foods
    Route::get('/all-foods', [App\Http\Controllers\AdminsController::class, 'allFoods'])->name('foods-all');
    Route::get('/delete-foods/{id}', [App\Http\Controllers\AdminsController::class, 'deleteFoods'])->name('foods-delete');
    Route::get('/create-foods', [App\Http\Controllers\AdminsController::class, 'createFoodsFrm'])->name('view-foods-form');
    Route::post('/create-foods', [App\Http\Controllers\AdminsController::class, 'storeFoods'])->name('store-foods');
});