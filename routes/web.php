<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\SleepSessionController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ActivitySessionController;
use App\Http\Controllers\ReportController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');

// Routes for manipulating days
Route::any('/days', [DayController::class, 'index'])->name('days.all');
Route::get('/days/create', [DayController::class, 'create'])->name('days.create');
Route::get('/days/show/{id}', [DayController::class, 'show'])->name('days.show');
Route::get('/days/edit/{id}', [DayController::class, 'edit'])->name('days.edit');
Route::post('/days/update/{id}', [DayController::class, 'update'])->name('days.update');

// Routes for manipulating sleep data
Route::get('/sleep/edit/{id}', [SleepSessionController::class, 'edit'])->name('sleep.edit');
Route::post('/sleep/update/{id}', [SleepSessionController::class, 'update'])->name('sleep.update');

// Routes for manipulating meals
Route::get('/meals/create/{dayId}', [MealController::class, 'create'])->name('meals.create');
Route::post('/meals/create', [MealController::class, 'store'])->name('meals.store');
Route::get('/meals/edit/{id}', [MealController::class, 'edit'])->name('meals.edit');
Route::post('/meals/update/{id}', [MealController::class, 'update'])->name('meals.update');
Route::get('/meals/destroy/{dayId}/{id}', [MealController::class, 'destroy'])->name('meals.destroy');

// Routes for manipulating activities
Route::get('/activities/sessions/create/{dayId}', [ActivitySessionController::class, 'create'])->name('activities.sessions.create');
Route::post('/activities/sessions/create', [ActivitySessionController::class, 'store'])->name('activities.sessions.store');
Route::get('/activities/sessions/edit/{id}', [ActivitySessionController::class, 'edit'])->name('activities.sessions.edit');
Route::post('/activities/sessions/update/{id}', [ActivitySessionController::class, 'update'])->name('activities.sessions.update');
Route::get('/activities/sessions/destroy/{dayId}/{id}', [ActivitySessionController::class, 'destroy'])->name('activities.sessions.destroy');

// Routes for reports
Route::get('/reports/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');
Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
Route::get('/reports/quarterly', [ReportController::class, 'quarterly'])->name('reports.quarterly');


