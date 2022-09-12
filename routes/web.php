<?php

use App\Http\Controllers\Admin\AddressesController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\MasajedController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ZamzamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {

    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('/user/create', [UsersController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [UsersController::class, 'store'])->name('admin.user.store');
    Route::get('/user/edit/{id}', [UsersController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/update/{id}', [UsersController::class, 'update'])->name('admin.user.update');
    Route::get('/user/destroy/{id}', [UsersController::class, 'destroy'])->name('admin.user.destroy');

    // Addresses
    Route::get('/addresses', [AddressesController::class, 'index'])->name('admin.addresses');
    Route::get('/address/create', [AddressesController::class, 'create'])->name('admin.address.create');
    Route::post('/address/store', [AddressesController::class, 'store'])->name('admin.address.store');
    Route::get('/address/edit/{id}', [AddressesController::class, 'edit'])->name('admin.address.edit');
    Route::post('/address/update/{id}', [AddressesController::class, 'update'])->name('admin.address.update');
    Route::get('/address/destroy/{id}', [AddressesController::class, 'destroy'])->name('admin.address.destroy');

    // News
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news/store', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::get('/news/destroy/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');


    // Banners
    Route::get('/banners', [BannersController::class, 'index'])->name('admin.banners');
    Route::get('/banner/create', [BannersController::class, 'create'])->name('admin.banner.create');
    Route::post('/banner/store', [BannersController::class, 'store'])->name('admin.banner.store');
    Route::get('/banner/edit/{id}', [BannersController::class, 'edit'])->name('admin.banner.edit');
    Route::post('/banner/update/{id}', [BannersController::class, 'update'])->name('admin.banner.update');
    Route::get('/banner/destroy/{id}', [BannersController::class, 'destroy'])->name('admin.banner.destroy');

    // Categories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories');
    Route::get('/category/create', [CategoriesController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CategoriesController::class, 'store'])->name('admin.category.store');
    Route::get('category/{id}', [CategoriesController::class, 'show'])->name('admin.category');
    Route::get('category/products/{id}', [CategoriesController::class, 'showCat'])->name('admin.category.products');
    Route::get('/category/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoriesController::class, 'update'])->name('admin.category.update');
    Route::get('/category/destroy/{id}', [CategoriesController::class, 'destroy'])->name('admin.category.destroy');

    // subCategories
    Route::get('/subs', [SubCategoriesController::class, 'index'])->name('admin.subs');
    Route::get('/sub/create', [SubCategoriesController::class, 'create'])->name('admin.sub.create');
    Route::post('/sub/store', [SubCategoriesController::class, 'store'])->name('admin.sub.store');
    Route::get('/sub/edit/{id}', [SubCategoriesController::class, 'edit'])->name('admin.sub.edit');
    Route::post('/sub/update/{id}', [SubCategoriesController::class, 'update'])->name('admin.sub.update');
    Route::get('/sub/destroy/{id}', [SubCategoriesController::class, 'destroy'])->name('admin.sub.destroy');


    // products
    Route::get('/products', [ProductsController::class, 'index'])->name('admin.products');
    Route::get('/product/create', [ProductsController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductsController::class, 'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('admin.product.update');
    Route::get('/product/destroy/{id}', [ProductsController::class, 'destroy'])->name('admin.product.destroy');

    // zamzam
    Route::get('/zamzam', [ZamzamController::class, 'index'])->name('admin.zamzam');
    Route::get('/zamzam/create', [ZamzamController::class, 'create'])->name('admin.zamzam.create');
    Route::post('/zamzam/store', [ZamzamController::class, 'store'])->name('admin.zamzam.store');
    Route::get('/zamzam/edit/{id}', [ZamzamController::class, 'edit'])->name('admin.zamzam.edit');
    Route::post('/zamzam/update/{id}', [ZamzamController::class, 'update'])->name('admin.zamzam.update');
    Route::get('/zamzam/destroy/{id}', [ZamzamController::class, 'destroy'])->name('admin.zamzam.destroy');

    // masajed
    Route::get('/masajed', [MasajedController::class, 'index'])->name('admin.masajed');
    Route::get('/masajed/create', [MasajedController::class, 'create'])->name('admin.masajed.create');
    Route::post('/masajed/store', [MasajedController::class, 'store'])->name('admin.masajed.store');
    Route::get('/masajed/edit/{id}', [MasajedController::class, 'edit'])->name('admin.masajed.edit');
    Route::post('/masajed/update/{id}', [MasajedController::class, 'update'])->name('admin.masajed.update');
    Route::get('/masajed/destroy/{id}', [MasajedController::class, 'destroy'])->name('admin.masajed.destroy');

    //Orders
    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');
    Route::get('/order/{id}', [OrdersController::class, 'show'])->name('admin.order.details');
    Route::post('/order/status/{id}', [OrdersController::class, 'changeStatus'])->name('order.status');
});
