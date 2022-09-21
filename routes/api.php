<?php

use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\MasajedController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SubCategoriesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ZamzamController;
use App\Http\Resources\ZamzamResource;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



Route::middleware('auth:api')->group(function(){

    Route::post('/add_address', [AddressesController::class, 'store']);
    Route::put('/edit_address/{id}', [AddressesController::class, 'update']);
    Route::post('/del_address/{id}', [AddressesController::class, 'destroy']);
    Route::get('/user_addresses', [AddressesController::class, 'user_addresses']);
    Route::get('/address/{id}', [AddressesController::class, 'show']);

    Route::post('edit_profile', [UserController::class, 'editData']);
    Route::post('change_password', [UserController::class, 'change_password']);
    Route::get('profile', [UserController::class, 'profile']);

    Route::post('addToCart/{id}', [CartController::class, 'addToCart']);
    Route::get('cartItems', [CartController::class, 'cartItems']);
    Route::post('addQuantity/{id}', [CartController::class, 'addQuantity']);
    Route::post('rmQuantity/{id}', [CartController::class, 'rmQuantity']);
    Route::post('removeItem/{id}', [CartController::class, 'removeItem']);

    Route::post('confirm_order', [OrdersController::class, 'confirm_order']);
    Route::get('order_details/{id}', [OrdersController::class, 'order_details']);

});

Route::post('send_code', [UserController::class, 'send_code']);
Route::post('confirm_code/{id}', [UserController::class, 'confirm_code']);
Route::post('password_reset', [UserController::class, 'password_reset']);

Route::get('news', [NewsController::class, 'index']);
Route::get('banners', [BannersController::class, 'index']);
Route::get('categories', [CategoriesController::class, 'index']);
Route::get('subcategories', [SubCategoriesController::class, 'index']);
Route::get('subcategory/{id}', [SubCategoriesController::class, 'comCat']);

Route::get('products', [ProductsController::class, 'index']);
Route::get('catproducts/{id}', [ProductsController::class, 'CatProducts']);

Route::get('special', [ZamzamController::class, 'index']);
Route::get('masajed', [MasajedController::class, 'index']);
