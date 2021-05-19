<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\RangkingController;

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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['checkIfAdmin:administrator']], function () {
        //Kaders Route
        Route::get('/kaders/print_pdf', [KaderController::class, 'generatePdf']);
        Route::resource('kaders', KaderController::class);
        
        //Users Route
        Route::get('/users/print_pdf', [UserController::class, 'generatePdf']);
        Route::resource('users', UserController::class);

        //Kriterias Route
        Route::get('/kriterias/print_pdf', [KriteriaController::class, 'generatePdf']);
        Route::resource('kriterias', KriteriaController::class);
        
        Route::get('rangkings/ahp', [RangkingController::class, 'index'])->name('rangkings.ahp');
        Route::get('rangkings/topsis', [RangkingController::class, 'index'])->name('rangkings.topsis');
        Route::resource('rangkings', RangkingController::class);
    });
 
});
