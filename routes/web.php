<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['protectRoute']], function(){
    Route::resources([
        '/orders' => OrderController::class,
        '/supplier' => SupplierController::class,
        '/companies' => CompanyController::class,
        '/products' => ProductController::class,
        '/transactions' => TransactionController::class,
        '/settings' => SettingController::class,
    ]);
    Route::get('/pos/orders',[OrderController::class,'pos'])->name('pos.order');
    Route::get('/pos/order/invoice/{order_id}',[OrderController::class,'posInvoice'])->name('pos.invoice');
    Route::group(['middleware' => ['authorizationRoute']], function(){
        Route::resources([
            '/users' => UserController::class,
            '/customers' => CustomerController::class,
        ]);
    });
});