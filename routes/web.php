<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserInArea;
use App\Http\Middleware\AdminAuth;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;



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

Route::get('/', [CategoryController::class, 'welcome'])->name('welcome');

// Admin -> panel
Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin_panel')->middleware(AdminAuth::class);
// --------------------------
Auth::routes();
Route::get('/business-register', [RegisterController::class, 'create_business'])->name('business_register_create');
Route::post('/business-register-store', [RegisterController::class, 'store_business'])->name('business_register_store');

Route::get('/search', [CategoryController::class, 'search'])->name('search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('show_category');

// Profile
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('edit_profile');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('update_profile');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('create_profile');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('store_profile');


Route::get('/{category:slug}/{profiles:url}', [ProfileController::class, 'show'])->name('show_profile')->middleware(CheckUserInArea::class);
Route::get('/profile', [ProfileController::class, 'index'])->name('my_profile');


// Admin -> login
Route::get('/admin', [AdminController::class, 'admin_login'])->name('admin_login');
Route::post('/admin-login-check', [AdminController::class, 'admin_login_check'])->name('admin_login_check');


// Admin -> users
Route::middleware([AdminAuth::class])->group(function() {

    Route::get('/admin/user/show-users', [AdminController::class, 'show_users'])->name('admin_users');
    Route::get('/admin/user/change-user-activeness/{user:id}/{activeness}', [AdminController::class, 'change_user_activenes'])->name('admin_user_activeness_change');
    
    // Admin -> categories
    Route::get('/admin/category/show-categories', [AdminController::class, 'show_categories'])->name('admin_categories');
    Route::get('/admin/category/change-category-activeness/{category:id}/{activeness}', [AdminController::class, 'change_category_activenes'])->name('admin_category_activeness_change');
    Route::get('/admin/category/edit-category/{category:id}', [AdminController::class, 'edit_category'])->name('admin_category_edit');
    Route::patch('/admin/category/update-category/{categoryId}', [AdminController::class, 'update_category'])->name('admin_category_update');
    Route::get('/admin/category/delete-category/{category:id}', [AdminController::class, 'delete_category'])->name('admin_category_delete');
    Route::get('/admin/category/delete-category/{category:id}/delete', [AdminController::class, 'delete_category_done'])->name('admin_category_delete_done');
    Route::get('/admin/category/create-category', [AdminController::class, 'create_category'])->name('admin_category_create');
    Route::post('/admin/category/store-category', [AdminController::class, 'store_category'])->name('admin_category_store');
    
    Route::get('/admin/profiles/show-profiles', [AdminController::class, 'show_profiles'])->name('admin_profiles');
    Route::get('/admin/profiles/change-profile-activeness/{profile:id}/{activeness}', [AdminController::class, 'change_profile_activenes'])->name('admin_profile_activeness_change');
});


