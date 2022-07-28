<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RegistrationClassController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Models\Classes;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('instructor', InstructorController::class);
Route::resource('plan', PlanController::class);
Route::resource('calendar', CalendarController::class);
Route::resource('event', EventController::class);

Route::get('event/{event}/presence', [EventController::class, 'presence'])->name('event.presence');
Route::get('event/{event}/absense', [EventController::class, 'absense'])->name('event.absense');
Route::put('event/{event}/absense', [EventController::class, 'absenseStore'])->name('event.absense.update');
Route::get('event/{event}/reschedule', [EventController::class, 'reschedule'])->name('event.reschedule');
Route::post('event/{event}/reschedule', [EventController::class, 'rescheduleStore'])->name('event.reschedule.store');

// Route::post('event', [EventController::class, 'index'])->name('event.index');

Route::resource('student', StudentController::class);
Route::resource('registration', RegistrationController::class);
Route::put('registration/{registration}/cancel', [RegistrationController::class, 'cancel'])->name('registration.cancel');
Route::resource('registration.class', RegistrationClassController::class);


