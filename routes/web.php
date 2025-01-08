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

//Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle']);
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/user', App\Http\Controllers\UserController::class);
});


/*
|--------------------------------------------------------------------------
| Regular user
|--------------------------------------------------------------------------
*/

Route::middleware(['admin.created','auth'])->group(function () {
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

    Route::get('salary/advance', [\App\Http\Controllers\SalaryAdvanceController::class, 'salaryAdvance'])->name('salary.advance');
    Route::post('process/salary/advance', [\App\Http\Controllers\SalaryAdvanceController::class, 'processSalaryAdvance'])->name('process.salary.advance');
    Route::get('staff/loans', [\App\Http\Controllers\LoanController::class, 'index'])->name('staff.loan');
    Route::post('process/staff/loans', [\App\Http\Controllers\LoanController::class, 'processLoan'])->name('process.staff.loan');
    Route::get('staff/loan/list', [\App\Http\Controllers\LoanController::class, 'loanList'])->name('staff.loan.list');
    Route::get('staff/loan/schedule/{id}', [\App\Http\Controllers\LoanController::class, 'loanSchedule']);
    Route::get('change/status/{id}', [\App\Http\Controllers\LoanController::class, 'changeStatus']);
});

