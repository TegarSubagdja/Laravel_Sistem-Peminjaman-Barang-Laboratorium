<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lab\labController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\item\itemController;
use App\Http\Controllers\rent\rentController;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\badge\badgeController;
use App\Http\Controllers\request\RequestController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\inventory\InventoryController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\resetPasswordController;

Route::middleware('guest')->group(function () {
  Route::post('/login', [LoginBasic::class, 'auth'])->name('login');
  Route::post('/register', [RegisterBasic::class, 'register'])->name('register');
  Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
  Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-forgot-password-basic');
  Route::get('/auth/reset-password-basic', [ForgotPasswordBasic::class, 'reset'])->name('auth-reset-password-basic');
  Route::get('/forgot-password', [resetPasswordController::class, 'forgotView'])->name('password.request');
  Route::post('/forgot-password', [resetPasswordController::class, 'sendResetLink'])->name('password.email');
  Route::get('/reset-password/{token}', [resetPasswordController::class, 'resetView'])->name('password.reset');
  Route::post('/reset-password', [resetPasswordController::class, 'resetPassword'])->name('password.update');
});


Route::middleware('auth')->group(function () {

  // livesearch
  Route::get('/index', [userController::class, 'index'])->name('index');
  Route::get('/search', [userController::class, 'search'])->name('search');

  // Auth
  Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');

  // Dashboard
  Route::get('/', [Analytics::class, 'index'])->name('dashboard');
  Route::post('/detail-item', [InventoryController::class, 'getItem'])->name('detail');

  // inventory
  Route::get('/inventory/basic', [InventoryController::class, 'index'])->name('inventory-basic');

  // Admin Access
  Route::middleware('admin')->group(function () {
    Route::get('/admin-panel', [AdminController::class, 'index'])->name('admin-panel');
    Route::post('/add-item', [itemController::class, 'addItem'])->name('addItem');
    Route::post('/add-loan', [RequestController::class, 'user'])->name('addLoan');
    Route::post('/add-loan-new', [RequestController::class, 'newUser'])->name('addLoan.new');
    Route::post('/add-lab', [labController::class, 'add'])->name('addLab.new');
    Route::post('/add-user', [userController::class, 'add'])->name('add.user');
    Route::post('/approve/{id}', [RequestController::class, 'approve'])->name('approve');
    Route::post('/reject/{id}', [RequestController::class, 'reject'])->name('reject');
    Route::post('/done/{id_loan}', [RequestController::class, 'done'])->name('done');
    Route::post('/update-user/{nrp}', [userController::class, 'update'])->name('update.user');
    Route::post('/update-item/{code}', [itemController::class, 'updateItem'])->name('update.item');
    Route::post('/update-lab/{id}', [labController::class, 'update'])->name('update.lab');
    Route::post('/delete-user/{nrp}', [userController::class, 'delete'])->name('delete.user');
    Route::post('/delete/{id_loan}', [RequestController::class, 'delete'])->name('delete.loan');
    Route::post('/delete-item/{code}', [itemController::class, 'deleteItem'])->name('delete.item');
    Route::post('/delete-lab/{code}', [labController::class, 'delete'])->name('delete.lab');
  });

  // Request
  Route::get('/request/basic', [RequestController::class, 'getRequest'])->name('request-basic');

  // Rent
  Route::post('/rent', [rentController::class, 'rent'])->name('rent');

  // Manage Menu Badge
  Route::get('/badge/add/{slug}/{badgeType}/{badgeText}', [badgeController::class, 'addBadge']);
  Route::get('/badge/remove/{slug}', [badgeController::class, 'removeBadge']);
});
