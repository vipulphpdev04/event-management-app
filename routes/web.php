<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventManagementController;
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
    return view('event_management');
});
Route::get('/add-event', [EventManagementController::class, 'create']);
Route::get('/get-event-list', [EventManagementController::class, 'index'])->name('events.index');
Route::post('/add-event', [EventManagementController::class, 'store'])->name('event.store');


