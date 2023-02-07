<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LoginController;
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

// Route::get('/', 'App\Http\Controllers\LoginController@index')->name('login');
Route::middleware(['guest', 'throttle:basic'])->group(function () {
    Route::get('/', [LoginController::class, "index"])->name('login');
    // Route::get('/','LoginController@index') -> name('home.index');
// pages - auth         
    Route::get('/login', [LoginController::class, "index"])->name('page.login');
    Route::get('/signup', [LoginController::class, "signup"])->name('page.signup');
// function - auth
    Route::post('/login', [LoginController::class, "authenticate"])->name('auth.login');
    Route::post('/register', [LoginController::class, "register"])->name('auth.register');
});

Route::middleware('auth')->group(function () {
/* pages */
// items
    Route::get('/practice', [ItemsController::class, "practice"])->name('page.item.practice');
    Route::get('/item', [ItemsController::class, "index"])->name('page.item.index');
    Route::get('/item/create', [ItemsController::class, "create"])->name('page.create');
    Route::get('/item/detail/{id}', [ItemsController::class, "show"])->name('page.item-detail');
    Route::get('/item/detail/{id}/edit', [ItemsController::class, "edit"])->name('page.item-edit');
    Route::get('/item/search', [ItemsController::class, "search"])->name('page.search');
// categories
    Route::get('/category', [CategoriesController::class, "index"])->name('page.category.index');
    Route::get('/category/create', [CategoriesController::class, "create"])->name('page.category.create');
    Route::get('/category/edit/{id}', [CategoriesController::class, "edit"])->name('page.category.edit');
// brands
    Route::get('/brand', [BrandsController::class, "index"])->name('page.brand.index');
    Route::get('/brand/create', [BrandsController::class, "create"])->name('page.brand.create');
    Route::get('/brand/edit', [BrandsController::class, "edit"])->name('page.brand.edit');

/* functions */
// auth
    Route::get('/logout', [LoginController::class, "logout"])->name('auth.logout');
// items
    Route::get('/items', [ItemsController::class, 'getAllItems'])->name('item.getAllItem');
    Route::post('/item/store', [ItemsController::class, "store"])->name('item.store');
    Route::put('/item/{id}', [ItemsController::class, "update"])->name('item.update');
    Route::delete('/item/{id}/delete', [ItemsController::class, "delete"])->name('item.delete');
// categories
    Route::post('/category', [CategoriesController::class, "store"])->name('category.store');
    Route::get('/category/detail/{id}', [CategoriesController::class, "getBrandNameFromCategoryId"])->name('category.detail');
    Route::delete('/category/{id}/delete', [CategoriesController::class, "delete"])->name('category.delete');
    Route::post('/category/detail/edit/{id}', [CategoriesController::class, "edit"])->name('category.edit');
// brands
    Route::post('/brand', [BrandsController::class, "store"])->name('brand.store');
    Route::delete('/brand/{id}/delete', [BrandsController::class, "delete"])->name('brand.delete');
    Route::get('/brand/by-category/{category_name}', [CategoriesController::class, "getBrandNameFromCategory"])->name('category.getbrandname');
});
