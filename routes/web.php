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

Route::get('/', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
Auth::routes();

Route::group(['middleware' => 'auth', 'admin'], function(){
    Route::get('/home', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
    Route::get('/pizzas', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
    Route::get('/pizza/create', [App\Http\Controllers\PizzaController::class, 'create'])->name('pizza.create');
    Route::get('/pizza/{id}/edit', [App\Http\Controllers\PizzaController::class, 'edit'])->name('pizza.edit');
    Route::get('/pizza/{id}/update', [App\Http\Controllers\PizzaController::class, 'update'])->name('pizza.update');
    Route::post('/pizza/store', [App\Http\Controllers\PizzaController::class, 'store'])->name('pizza.store');
    
    //orden de usuario
    Route::get('/user/order', [App\Http\Controllers\UserOrderController::class, 'create'])->name('user.order');
});

