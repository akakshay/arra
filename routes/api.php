<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/register-shop', [AuthController::class, 'register']);   
        Route::get('/shop', [ShopController::class, 'index'] );
        Route::get('/shop/{shop}',[ShopController::class, 'show']);
        Route::post('/shop',  [ShopController::class, 'store']);
        Route::put('/shop/{shop}',[ShopController::class, 'update']);
        Route::delete('/shop/{shop}', [ShopController::class, 'delete']); 
});