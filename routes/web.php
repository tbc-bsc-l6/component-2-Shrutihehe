<?php

use App\Http\Controllers\TestsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    return view('index');
})->name('main');

Route::get('/test/{subject_id}', [TestsController::class, "getTestQuestions"])->name('getTestQuestion')->middleware('auth'); //only allows to take test when login.

Route::post('/submitExam', [TestsController::class, "submitExam"])->name('submitExam');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('dashboard',[\App\Http\Controllers\DashboardController::class, "dashboard"])->name('dashboard');
});
Route::get('/register_exam/{subject_id}',[TestsController::class,"registerExam"])->name('registerExam');


Route::get('/allResults',[TestsController::class,"allResults"])->name('allResults');
Route::get('/allTests',[TestsController::class,"allTests"])->name('allTests');
