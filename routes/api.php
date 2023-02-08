<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'api'], function () {
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::get('auth/user-profile', [AuthController::class, 'userProfile']);
    Route::post('auth/register-shop', [AuthController::class, 'register']);

    Route::resource('shop', ShopController::class);

    Route::get('get-shops', [ShopController::class, 'getShops']);
    Route::get('get-reviews/{shop}', [ShopController::class, 'getReviews']);
    Route::post('post-shop-review/{shop}', [ShopController::class, 'postShopReview']);
});
