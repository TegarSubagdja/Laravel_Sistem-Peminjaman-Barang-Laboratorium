<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\request\RequestController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\inventory\InventoryController;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\badge\badgeController;
use App\Http\Controllers\detailScan\detailScanController;
use App\Http\Controllers\rent\rentController;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// livesearch
Route::get('/index', [userController::class, 'index'])->name('index');
Route::get('/search', [userController::class, 'search'])->name('search');

// authentication
Route::post('/login', [LoginBasic::class, 'auth'])->name('login');
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

Route::middleware('auth')->group(function () {

  // Auth
  Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');
  Route::post('/register', [RegisterBasic::class, 'register'])->name('register');

  // Dashboard
  Route::get('/', [Analytics::class, 'index'])->name('dashboard');
  Route::post('/detail-item', [InventoryController::class, 'getItem'])->name('detail');

  // inventory
  Route::get('/inventory/basic', [InventoryController::class, 'index'])->name('inventory-basic');
  Route::post('/item', [InventoryController::class, 'getItems'])->name('detail');
  Route::get('/inventory/search', [InventoryController::class, 'search'])->name('search');

  // Admin

  // Admin Access
  Route::middleware('admin')->group(function () {
    Route::get('/admin-panel', [AdminController::class, 'index'])->name('admin-panel');
    Route::post('/add-item', [InventoryController::class, 'addItem'])->name('addItem');
    Route::post('/add-loan', [RequestController::class, 'user'])->name('addLoan');
    Route::post('/add-loan-new', [RequestController::class, 'newUser'])->name('addLoan.new');
    Route::post('/approve/{id_loan}', [RequestController::class, 'approve'])->name('approve');
    Route::post('/done/{id_loan}', [RequestController::class, 'done'])->name('done');
    Route::post('/delete/{id_loan}', [RequestController::class, 'delete'])->name('delete');
    Route::post('/add-user', [userController::class, 'add'])->name('add.user');
    Route::post('/delete-user/{nrp}', [userController::class, 'delete'])->name('delete.user');
    Route::post('/update-user/{nrp}', [userController::class, 'update'])->name('update.user');
  });

  // Request
  Route::get('/request/basic', [RequestController::class, 'getRequest'])->name('request-basic');

  // Rent
  Route::post('/rent', [rentController::class, 'rent'])->name('rent');

  // Manage Menu Badge
  Route::get('/badge/add/{slug}/{badgeType}/{badgeText}', [badgeController::class, 'addBadge']);
  Route::get('/badge/remove/{slug}', [badgeController::class, 'removeBadge']);

  // // Result Scanner
  // Route::get('/data/{value}', [detailScanController::class, 'index']);

  // Route::get('/data/{value}', function ($value) {
  //   return response()->json(['success' => true, 'data' => $value]);
  // });

  // Route::post('/data', [detailScanController::class, 'receiveData']);

  // Route::post('/datas', function (Request $request) {
  //   return response()->json([
  //     'message' => 'Data received successfully',
  //     'data' => $request->all(),
  //   ]);
  // });
});

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
