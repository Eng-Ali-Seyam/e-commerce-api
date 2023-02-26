<?php

use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\RegisterApiController;
use App\Http\Controllers\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\Feature\ProductsApiTest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){
    Route::post('register',[PassportAuthController::class,'register'])->name('api.register');
    Route::post('login',[PassportAuthController::class,'login'])->name('api.login');
    Route::resource('products',ProductsApiController::class)->names([
        'index' => 'api.products',
        'store' => 'api.products.store' ,
        'show' => 'api.products.show' ,
        'destroy' => 'api.products.delete' ,
        'update' => 'api.products.update' ,
    ]);
});
