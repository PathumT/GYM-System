<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/',                                                [App\Http\Controllers\PaymentUpController::class, 'dashboard'])->name('dashboard');
    Route::get('/main_payment',                                     [App\Http\Controllers\PaymentUpController::class, 'view_main_payment'])->name('main_payment');
    Route::post('add_paymentdetails',                              [App\Http\Controllers\PaymentUpController::class, 'add_paymentdetails'])->name('add_paymentdetails');
    Route::get('deleteBook/{id}',                                  [App\Http\Controllers\PaymentUpController::class, 'deleteBook'])->name('deleteBook');
    Route::get('editBook/{id}',                                    [App\Http\Controllers\PaymentUpController::class, 'editBook'])->name('editBook');
    Route::post('update_book/{id}',                                [App\Http\Controllers\PaymentUpController::class, 'update_book'])->name('update_book');


    Route::get('/user_list',                                       [App\Http\Controllers\UserController::class, 'view_user_list'])->name('user_list')->middleware('auth');
    Route::post('create_users',                                    [App\Http\Controllers\UserController::class, 'create_users'])->name('create_users');
    Route::get('deleteUser/{id}',                                  [App\Http\Controllers\UserController::class, 'deleteUser']);
    Route::get('edit_user/{id}',                                   [App\Http\Controllers\UserController::class, 'edit_user']);
    Route::post('update_user/{id}',                                [App\Http\Controllers\UserController::class, 'update_user'])->name('update_user');
    Route::post('update_role/{id}',                                [App\Http\Controllers\UserController::class, 'update_role']);
    Route::get('/user_edit/{id}',                                  [App\Http\Controllers\UserController::class, 'view_user_edit'])->name('user_edit')->middleware('auth');

    Route::get('/user_list',                                       [App\Http\Controllers\UserController::class, 'view_user_list'])->name('user_list')->middleware('auth');
    Route::post('create_users',                                    [App\Http\Controllers\UserController::class, 'create_users'])->name('create_users');
    Route::get('deleteUser/{id}',                                  [App\Http\Controllers\UserController::class, 'deleteUser']);
    Route::get('edit_user/{id}',                                   [App\Http\Controllers\UserController::class, 'edit_user']);
    Route::post('update_user/{id}',                                [App\Http\Controllers\UserController::class, 'update_user'])->name('update_user');

    Route::post('/send-whatsapp-message', 'PaymentUpController@sendWhatsAppMessage');

});


require __DIR__ . '/auth.php';
