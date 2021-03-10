<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\SubCatController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\WishlistController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Admin\SubCategoryController as AdminSubCategoryController;

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

Route::get('/lang/set/{lang}', [LangController::class, 'set']);

Route::middleware('web_lang')->group(function () {

    //home
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/search', [HomeController::class, 'search']);


    //supCats
    Route::get('/sub-categories/show/{subcategory}', [SubCatController::class, 'show']);

    //products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/most-popular', [ProductController::class, 'mostPopular']);
    Route::get('/products/new-products', [ProductController::class, 'newIn']);
    Route::get('/products/low-price', [ProductController::class, 'lowPrice']);
    Route::get('/products/hight-price', [ProductController::class, 'hightPrice']);
    Route::get('/products/show/{product}', [ProductController::class, 'showProduct']);




    Route::middleware(['auth', 'user'])->group(function () {

        //reviews
        Route::get('/products/review/{product}', [ReviewController::class, 'addReview']);
        Route::post('/products/review/store/{product}', [ReviewController::class, 'storeReview']);


        //Carts
        Route::get('/cart', [CartController::class, 'showCart']);
        Route::post('/cart/add-cart/{product}', [CartController::class, 'addToCart']);
         Route::put('/cart/update/{id}',  [CartController::class, 'update']);
        Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

        // //Check out
        Route::get('/checkout', [CheckoutController::class, 'showCheckOut']);
        Route::post('/checkout/store', [CheckoutController::class, 'storeCheckOut']);

        // //Wishlist
        Route::get('/wishlist', [WishlistController::class, 'index']);
        Route::post('/wishlist/add/{product}', [WishlistController::class, 'store']);
        Route::post('/wishlist/delete/{wishlist}', [WishlistController::class, 'delete']);
    });
});


Route::prefix('dashboard')->middleware(['auth', 'dashboard'])->group(function () {

    // Admin
    Route::get('/', [AdminHomeController::class, 'index']);

    //admin-Department
    Route::get('/departments', [AdminDepartmentController::class, 'index']);
    Route::post('/departments/store', [AdminDepartmentController::class, 'store']);

    Route::post('/departments/update', [AdminDepartmentController::class, 'update']);

    Route::get('/departments/delete/{department}', [AdminDepartmentController::class, 'delete']);
    Route::get('/departments/toggle/{department}', [AdminDepartmentController::class, 'toggle']);

    //admin-Categories
    Route::get('/categories', [AdminCategoryController::class, 'index']);

    Route::post('/categories/store', [AdminCategoryController::class, 'store']);

    Route::post('/categories/update', [AdminCategoryController::class, 'update']);
    Route::get('/categories/delete/{category}', [AdminCategoryController::class, 'delete']);
    Route::get('/categories/toggle/{category}', [AdminCategoryController::class, 'toggle']);



    // //admin-Sub-Categories
    Route::get('/sub-categories', [AdminSubCategoryController::class, 'index']);
    Route::post('/sub-categories/store', [AdminSubCategoryController::class, 'store']);
    Route::post('/sub-categories/update', [AdminSubCategoryController::class, 'update']);
    Route::get('/sub-categories/delete/{subcategory}', [AdminSubCategoryController::class, 'delete']);
    Route::get('/sub-categories/toggle/{subcategory}', [AdminSubCategoryController::class, 'toggle']);

    // //admin-Product
    Route::get('/products', [AdminProductController::class, 'index']);
    Route::get('/products/show/{product}', [AdminProductController::class, 'show']);
    Route::get('/products/create', [AdminProductController::class, 'create']);
    Route::post('/products/store', [AdminProductController::class, 'store']);
    Route::get('/products/edit/{product}', [AdminProductController::class, 'edit']);
    Route::post('/products/update/{product}', [AdminProductController::class, 'update']);
    Route::get('/products/delete/{product}', [AdminProductController::class, 'delete']);
    Route::get('/products/toggle/{product}', [AdminProductController::class, 'toggle']);


    // //admin-orders
    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::get('/orders/show/{order}', [AdminOrderController::class, 'show']);
    Route::get('/orders/delete/{order}', [AdminOrderController::class, 'delete']);
    Route::get('/orders/canceled/{order}', [AdminOrderController::class, 'canceled']);
    Route::get('/orders/approved/{order}', [AdminOrderController::class, 'approved']);



    Route::middleware('super_admin')->group(function(){

        Route::get('/admins', [AdminController::class, 'index']);
        Route::get('/admins/create', [AdminController::class, 'create']);
        Route::post('/admins/store', [AdminController::class, 'store']);
        Route::get('/admins/promot/{id}', [AdminController::class, 'promot']);
        Route::get('/admins/demot/{id}', [AdminController::class, 'demot']);
        Route::get('/admins/delete/{id}', [AdminController::class, 'delete']);
    });
});
