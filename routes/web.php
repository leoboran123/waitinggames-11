<?php

use App\Http\Controllers\HouseController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserInArea;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\ProfileActive;



use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;






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

Route::get('/', [HouseController::class, 'welcome'])->name('welcome');

// Admin -> panel
Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin_panel')->middleware(AdminAuth::class);
// --------------------------
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Profile
Route::middleware([Authenticate::class])->group(function(){

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('edit_profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('update_profile');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('create_profile');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('store_profile');


    Route::get('/profile', [ProfileController::class, 'index'])->name('my_profile');

    Route::get('/play', [GameController::class, 'index'])->name('game_index')->middleware(CheckUserInArea::class);
    Route::get('/getScore', [GameController::class, 'store_score'])->name('get_score')->middleware(CheckUserInArea::class);


});

// Admin -> login
Route::get('/admin', [AdminController::class, 'admin_login'])->name('admin_login');
Route::post('/admin-login-check', [AdminController::class, 'admin_login_check'])->name('admin_login_check');


// Admin -> users
Route::middleware([AdminAuth::class])->group(function() {

    Route::get('/admin/user/show-users', [AdminController::class, 'show_users'])->name('admin_users');
    Route::get('/admin/user/change-user-activeness/{user:id}/{activeness}', [AdminController::class, 'change_user_activenes'])->name('admin_user_activeness_change');
    
    
    Route::get('/admin/profiles/show-profiles', [AdminController::class, 'show_profiles'])->name('admin_profiles');
    Route::get('/admin/profiles/change-profile-activeness/{profile:id}/{activeness}', [AdminController::class, 'change_profile_activenes'])->name('admin_profile_activeness_change');

    Route::get('/admin/businesess/show-businesess', [AdminController::class, 'show_businesess'])->name('admin_businesess');
    Route::get('/admin/businesess/create', [AdminController::class, 'create_business'])->name('admin_business_create');
    Route::post('/admin/businesess/store', [AdminController::class, 'store_business'])->name('admin_business_store');
    
    Route::get('/admin/businesess/change-business-activeness/{business:id}/{activeness}', [AdminController::class, 'change_business_activenes'])->name('admin_business_activeness_change');
    Route::get('/admin/businesess/edit/{business:id}', [AdminController::class, 'edit_business'])->name('admin_business_edit');
    Route::post('/admin/businesess/update/{business_id}', [AdminController::class, 'update_business'])->name('admin_business_update');
    Route::get('/admin/businesess/delete/{business_id}', [AdminController::class, 'delete_business'])->name('admin_business_delete');
    Route::post('/admin/businesess/delete_done/{business_id}', [AdminController::class, 'delete_business_done'])->name('admin_business_delete_done');


    Route::get('/admin/gamescore/', [AdminController::class, 'admin_gamescore'])->name('admin_gamescore');
    Route::get('/admin/gamescore/change-gamescore-activeness/{gamescore:id}/{activeness}', [AdminController::class, 'change_gamescore_activenes'])->name('admin_gamescore_activeness_change');

});


