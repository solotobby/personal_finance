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
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| Admin setup routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/setup', [App\Http\Controllers\AdminSetupController::class, 'create'])->name('setup.create');
Route::post('/admin/setup', [App\Http\Controllers\AdminSetupController::class, 'store'])->name('setup');


Auth::routes();

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
    Route::resource('transactions', App\Http\Controllers\TransactionController::class);

    Route::resource('budget', App\Http\Controllers\BudgetController::class);
    Route::get('mark/{id}', [App\Http\Controllers\BudgetController::class, 'markDone']);
    Route::get('delete/budget/{id}', [App\Http\Controllers\BudgetController::class, 'remove']);
    Route::get('filter/transaction', [App\Http\Controllers\TransactionController::class, 'filter']);
});
