<?php

use App\Events\NewProductEvent;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use App\Mail\EmailMailable;
use App\Models\Product;
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


Route::resource( 'categories',CategoriesController::class)->middleware(['auth','validated']);
Route::resource( 'products', ProductController::class)->middleware('auth');
Route::get('/send-email', function (){


    $users = \App\Models\User::all();
    if ($users->count() > 0) {
        foreach($users as $key => $value){
            if (!empty($value->email)) {
                Mail::to($value->email)->send(new \App\Mail\TestMailTrap());
            }
        }
    }

})->name('send_email');
//->names([
//    'destroy' => 'products.delete',
//    'store' => 'products.store',
//    'update' => 'products.update'
//])
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard/', 'index')->name('dashboard');
    Route::get('/dashboard/my_products', 'all_products')->name('all_products');
    Route::get('/dashboard/add_product', 'add_products')->name('add_product');
    Route::get('/dashboard/admin', 'admin')->name('users');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
