<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index']);//->name('home');
Route::post('/category', [App\Http\Controllers\CategoriesController::class, 'store']);//->name('home');
Route::post('/transaction', [App\Http\Controllers\TransactionController::class, 'store']);//->name('home');
Route::get('/budget', [App\Http\Controllers\BudgetController::class, 'index']);//->name('home');
Route::resource('budget', BudgetController::class);
//Route::post('create/budget', [App\Http\Controllers\BudgetController::class, 'store'])->name('store.budget');
//Route::get('view/budget', [App\Http\Controllers\BudgetController::class, 'viewBudget']);//->name('store.budget');
Route::get('mark/{id}', [App\Http\Controllers\BudgetController::class, 'markDone']);//->name('store.budget');
Route::get('delete/budget/{id}', [App\Http\Controllers\BudgetController::class, 'remove']);//->name('store.budget');
Route::get('all/transactions', [App\Http\Controllers\TransactionController::class, 'index']);//->name('store.budget');
