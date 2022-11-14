<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Models\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Banner;
use App\Models\SubCategory;

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
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact',[HomeController::class, 'contact'])->name('contact');
Route::get('/product', [HomeController::class, 'product'])->name('shop');

Route::get('/view_product/{slug}', [HomeController::class, 'viewProduct'])->name('view_product');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.login');
Route::post('/login_auth', [AdminController::class, 'adminLogin'])->name('admin.login_auth');

// Admin Register Route
Route::get('/register', [AdminController::class, 'registerFormLoad'])->name('admin.register');
Route::post('/regiser_auth',[AdminController::class, 'registerAdmin'])->name('admin.register_auth');

Route::middleware('admin_auth')->group(function(){
    Route::get('/dashboard',[AdminController::class, 'openDashboard'])->name('dashboard');
    // admin profile
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.update_profile');
    Route::get('/delete_image/{id}',[AdminController::class, 'deleteAdminProfileImage'])->name('admin.delete_profile_image');
    //change admin's password by admin
    Route::post('/chnage_password', [AdminController::class, 'changePassword'])->name('admin.change_password');


    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/add_category', [CategoryController::class, 'add_category'])->name('add_category');


    // sub category:
    Route::get('sub_category', [SubCategoryController::class, 'index'])->name('sub_category');
    Route::post('/add_sub_category', [SubCategoryController::class, 'addSubCategory'])->name('add__sub_category');

    // Products routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/getsubcategory', [ProductController::class, 'getsubcategory'])->name('getsubcategory');

    Route::post('/add_product', [ProductController::class, 'addProduct'])->name('add__product');
    Route::get('/category/{slug}', [ProductController::class, 'category_wise_view'])->name('category_view');
    Route::get('/product_details/{slug}', [ProductController::class, 'productDetails'])->name('product_details');

    // Banner
    Route::get('/banners', [BannerController::class, 'index'])->name('banners');
    Route::post('/add_banner',[BannerController::class, 'addBanner'])->name('add_banner');
    // log out route
    Route::get('/logout',[AdminController::class, 'logout'])->name('logout');
});
