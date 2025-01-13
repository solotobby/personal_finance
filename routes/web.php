<?php

use Illuminate\Support\Facades\Auth;
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
    return auth()->user() ? redirect('dashboard') : view('landing_page');
});

Route::post('/login/user', [App\Http\Controllers\Auth\LoginController::class, 'loginUser'])->name('login.user');
Route::post('/register/user', [App\Http\Controllers\Auth\RegisterController::class, 'createUser'])->name('register.user');
Route::post('show-register', [App\Http\Controllers\Auth\RegisterController::class, 'createUser'])->name('register');

Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);


/*
|--------------------------------------------------------------------------
| Admin setup routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/setup', [App\Http\Controllers\AdminSetupController::class, 'create'])->name('setup.create');
Route::post('/admin/setup', [App\Http\Controllers\AdminSetupController::class, 'store'])->name('setup');

Route::middleware('admin.created')->group(function () {
    Auth::routes();
});

/*
|--------------------------------------------------------------------------
| Admin only Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('/user', App\Http\Controllers\UserController::class);
});


/*
|--------------------------------------------------------------------------
| Regular user
|--------------------------------------------------------------------------
*/

Route::middleware(['admin.created', 'auth'])->group(function () {

    Route::post('/create-business-account', [App\Http\Controllers\BusinessController::class, 'create'])->name('create.business.account');
   // Route::post('/create-business-account', [App\Http\Controllers\Auth\RegisterController::class, 'createBusinessAccount'])->name('create.business.account');
    Route::get('/create-business-account', [App\Http\Controllers\Auth\LoginController::class, 'showCreateBusinessAccountPage'])->name('create-business-account-page');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index']);
    Route::get('/calender', [App\Http\Controllers\CalenderController::class, 'index'])->name('calender');
    Route::post('/category', [App\Http\Controllers\CategoriesController::class, 'store']);
    Route::get('transactions/summary', [App\Http\Controllers\TransactionController::class, 'summary'])->name('transactions.summary');
    Route::get('transactions/report', [App\Http\Controllers\TransactionController::class, 'report'])->name('transactions.report');
    Route::resource('transactions', App\Http\Controllers\TransactionController::class);

    //Budget Mechanism
    Route::resource('budget', App\Http\Controllers\BudgetController::class);
    Route::get('budgets/summary', [\App\Http\Controllers\BudgetController::class, 'viewBudget']);
    Route::get('mark/{id}', [App\Http\Controllers\BudgetController::class, 'markDone']);
    Route::get('delete/budget/{id}', [App\Http\Controllers\BudgetController::class, 'remove']);

    //Staff
    Route::get('staffs', [\App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
    Route::get('fetch/staffs', [\App\Http\Controllers\StaffController::class, 'fetchStaffs']);
    Route::get('create/staff', [\App\Http\Controllers\StaffController::class, 'createStaff']);
    Route::post('add/staff', [\App\Http\Controllers\StaffController::class, 'AddStaff']);
    Route::get('staff/{staff_id}', [\App\Http\Controllers\StaffController::class, 'showSingleStaff'])->name('staff.show');

   // PaySlip
    Route::get('generate/payslip/{staff_id}', [\App\Http\Controllers\PaySlipController::class, 'generatePayslip'])->name('generate.payslip');


    Route::get('salary/advance', [\App\Http\Controllers\SalaryAdvanceController::class, 'salaryAdvance'])->name('salary.advance');
    Route::post('process/salary/advance', [\App\Http\Controllers\SalaryAdvanceController::class, 'processSalaryAdvance'])->name('process.salary.advance');
    Route::get('staff/loans', [\App\Http\Controllers\LoanController::class, 'index'])->name('staff.loan');
    Route::post('process/staff/loans', [\App\Http\Controllers\LoanController::class, 'processLoan'])->name('process.staff.loan');
    Route::get('staff/loan/list', [\App\Http\Controllers\LoanController::class, 'loanList'])->name('staff.loan.list');
    Route::get('staff/loan/schedule/{id}', [\App\Http\Controllers\LoanController::class, 'loanSchedule']);
    Route::get('change/status/{id}', [\App\Http\Controllers\LoanController::class, 'changeStatus']);

    //Profile
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

    //settings
    Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
  //  Route::get('settings/view', [\App\Http\Controllers\SettingsController::class, 'viewPage'])->name('settings.index');
    Route::post('settings/category', [\App\Http\Controllers\SettingsController::class, 'storeCategory'])->name('settings.storeCategory');
    Route::post('/settings/storeType', [\App\Http\Controllers\SettingsController::class, 'storeType'])->name('settings.storeType');
    Route::post('settings/role', [\App\Http\Controllers\SettingsController::class, 'storeRole'])->name('settings.storeRole');
    Route::post('settings/department', [\App\Http\Controllers\SettingsController::class, 'storeDepartment'])->name('settings.storeDepartment');
    Route::post('settings/qualification', [\App\Http\Controllers\SettingsController::class, 'storeQualification'])->name('settings.storeQualification');
});
