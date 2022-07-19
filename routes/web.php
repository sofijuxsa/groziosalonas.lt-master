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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/services', [App\Http\Controllers\ClientController::class, 'index'])->name('services');
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'show'])->name('services');

Route::get('/artist/edit', [App\Http\Controllers\ArtistController::class, 'edit'])->name('artist.edit');
Route::post('/artist/update/{id}', [App\Http\Controllers\ArtistController::class, 'update'])->name('artist.update');

Route::get('/schedule/form', [App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule.form');
Route::post('/schedule/form', [App\Http\Controllers\ScheduleController::class, 'disableDay'])->name('schedule.disableDay');
Route::post('/schedule/form/enable', [App\Http\Controllers\ScheduleController::class, 'enableDay'])->name('schedule.enableDay');

Route::post('/schedule/update', [App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule.update');

Route::get('/booking', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.form');
Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

Route::post('/booking/filterArtist', [App\Http\Controllers\ArtistController::class, 'filterArtist'])->name('artist.filter');
Route::post('/booking/filterSchedule', [App\Http\Controllers\ScheduleController::class, 'filterSchedule'])->name('schedule.filter');
Route::get('/schedule/form/disabled', [App\Http\Controllers\ScheduleController::class, 'filterSchedule2'])->name('schedule.filter2');

Route::post('/booking/filterBooking', [App\Http\Controllers\BookingController::class, 'filterBooking'])->name('booking.filter');

Route::post('/booking/getDuration', [App\Http\Controllers\ServiceController::class, 'getDuration'])->name('service.duration');

Route::get('/artist/bookings', [App\Http\Controllers\ArtistController::class, 'myReservations'])->name('artist.bookings');
Route::post('/artist/bookings/{id}/delete', [App\Http\Controllers\BookingController::class, 'delete'])->name('booking.delete');
Route::post('/artist/booking/{id}/activity', [App\Http\Controllers\BookingController::class, 'changeActivity'])->name('booking.activity');
