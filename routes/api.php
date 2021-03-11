<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\SubcategoryController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);



Route::middleware('api_lang')->group(function () {

    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::get('/departments/show/{id}', [DepartmentController::class, 'show']);


    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/show/{id}', [CategoryController::class, 'show']);

    Route::get('/sub-categories', [SubcategoryController::class, 'index']);
    Route::get('/sub-categories/show/{id}', [SubcategoryController::class, 'show']);


    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/show/{id}', [ProductController::class, 'show']);
    Route::get('/products/most-popular', [ProductController::class, 'most_popular']);
    Route::get('/products/new-products', [ProductController::class, 'new_products']);
    Route::get('/products/low-price', [ProductController::class, 'low_price']);
    Route::get('/products/hight-price', [ProductController::class, 'hight_price']);


    Route::middleware(['api', 'auth:sanctum'])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/products/review/store/{product}', [ProductController::class, 'storeReview']);

        Route::get('/wishlist', [WishlistController::class, 'index']);
        Route::post('/wishlist/add/{product}', [WishlistController::class, 'store']);
        Route::post('/wishlist/delete/{product}', [WishlistController::class, 'delete']);


        //Carts
        Route::get('/cart', [CartController::class, 'showCart']);
        Route::post('/cart/add-to-cart/{product}', [CartController::class, 'addToCart']);
        Route::post('/cart/update/{product}',  [CartController::class, 'update']);
        Route::get('/cart/remove/{product}', [CartController::class, 'remove']);

        // //Check out
        Route::get('/checkout', [CheckoutController::class, 'showCheckOut']);
        Route::post('/checkout/store', [CheckoutController::class, 'storeCheckOut']);
    });
});
