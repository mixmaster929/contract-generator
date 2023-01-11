<?php

use App\Http\Controllers\Backend\AssignPermissionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ShortCodesController;
use App\Http\Controllers\Backend\TemplateController;
use App\Http\Controllers\Backend\FormsController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ResetPasswordUserController;
use App\Http\Controllers\Backend\SettingController;
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

Route::get('/', function () {
    return redirect()->route('login');
})->name('home.index');

Auth::routes(
    // [
    //     'register' => false, // Registration Routes...
    //     'reset' => false, // Password Reset Routes...
    //     'verify' => false, // Email Verification Routes...
    // ]
);

Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::group(['prefix' => 'shortcodes'], function () {
        Route::get('/', [ShortCodesController::class, 'index'])->name('shortcodes.index');
        Route::get('/create', [ShortCodesController::class, 'create'])->name('shortcodes.create');
        Route::post('/', [ShortCodesController::class, 'store'])->name('shortcodes.store');
        Route::get('/{user}/edit', [ShortCodesController::class, 'edit'])->name('shortcodes.edit');
        Route::put('/{user}', [ShortCodesController::class, 'update'])->name('shortcodes.update');
        Route::delete('/{user}', [ShortCodesController::class, 'destroy'])->name('shortcodes.destroy');
        Route::get('/{user}', [ShortCodesController::class, 'show'])->name('shortcodes.show');
    });

    Route::group(['prefix' => 'templates'], function () {
        Route::get('/', [TemplateController::class, 'index'])->name('templates.index');
        Route::get('/create', [TemplateController::class, 'create'])->name('templates.create');
        Route::post('/', [TemplateController::class, 'store'])->name('templates.store');
        Route::get('/{user}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
        Route::put('/{user}', [TemplateController::class, 'update'])->name('templates.update');
        Route::delete('/{user}', [TemplateController::class, 'destroy'])->name('templates.destroy');
        Route::get('/{user}', [TemplateController::class, 'show'])->name('templates.show');
    });

    Route::group(['prefix' => 'forms'], function () {
        Route::get('/', [FormsController::class, 'index'])->name('forms.index');
        Route::get('/create', [FormsController::class, 'create'])->name('forms.create');
        Route::post('/', [FormsController::class, 'store'])->name('forms.store');
        Route::get('/{user}/edit', [FormsController::class, 'edit'])->name('forms.edit');
        Route::put('/{user}', [FormsController::class, 'update'])->name('forms.update');
        Route::delete('/{user}', [FormsController::class, 'destroy'])->name('forms.destroy');
        Route::get('/{user}', [FormsController::class, 'show'])->name('forms.show');
    });
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update/{id}', [ProfileController::class, 'updateGeneralInformation'])->name('profile.update.information');
    Route::put('/profile/update/password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile/update/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    Route::group(['prefix' => 'assignpermission'], function () {
        Route::get('/', [AssignPermissionController::class, 'index'])->name('assignpermission.index');
        Route::get('/{role}/edit', [AssignPermissionController::class, 'editRolePermission'])->name('assignpermission.edit');
        Route::post('/updaterolepermission', [AssignPermissionController::class, 'updateRolePermission'])->name('assignpermission.update');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');

        Route::put('/users/{user}/resetpassword', [ResetPasswordUserController::class, 'resetPassword'])->name('users.reset.password');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/index', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/updateinformation/{setting}/', [SettingController::class, 'updateInformation'])->name('setting.update.information');
        Route::put('/updatelogo/{setting}/', [SettingController::class, 'updateLogo'])->name('setting.update.logo');
        Route::put('/updatefrontimage/{setting}/', [SettingController::class, 'updateFrontImage'])->name('setting.update.front.image');
    });
});
