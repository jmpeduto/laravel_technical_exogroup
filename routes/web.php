<?php

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

// Route::get('/', function () {
//     return view('/pizza/index');
//     // Route::get('/home', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
// });

Auth::routes();
// Route::get('/', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
Route::get('/', [App\Http\Controllers\FrontEndController::class, 'index'])->name('frontpage');

Route::group(['middleware' => 'auth', 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
    Route::get('/pizzas', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
    Route::get('/pizza/create', [App\Http\Controllers\PizzaController::class, 'create'])->name('pizza.create');
    Route::get('/pizza/{id}/edit', [App\Http\Controllers\PizzaController::class, 'edit'])->name('pizza.edit');
    Route::put('/pizza/{id}/update', [App\Http\Controllers\PizzaController::class, 'update'])->name('pizza.update');
    Route::delete('/pizza/{id}/delete', [App\Http\Controllers\PizzaController::class, 'destroy'])->name('pizza.destroy');
    Route::post('/pizza/store', [App\Http\Controllers\PizzaController::class, 'store'])->name('pizza.store');

    //orden de usuario
    Route::get('/user/order', [App\Http\Controllers\UserOrderController::class, 'index'])->name('user.order');
    Route::post('/order/{id}/status', [App\Http\Controllers\UserOrderController::class, 'changeStatus'])->name('order.status');
    // Route::post('/order/status', [App\Http\Controllers\UserOrderController::class, 'changeStatus'])->name('order.status');
});
