<?php

use App\Http\Controllers\Admin\AddressesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UsersController;
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

});
