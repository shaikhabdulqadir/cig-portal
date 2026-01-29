<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\AddonController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::redirect('/', '/login');

Route::get('/signup', function () {
    return inertia('Signup');
});

Route::post('/signup', [UserController::class,'signup'])->name('signup');

Route::post('/payment/{plan_id}', [UserController::class,'payment'])->name('payment');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

Route::get('/plans', [UserController::class,'plans'])->name('plans');
Route::post('/subscribe', [UserController::class,'subscribe'])->name('subscribe');
Route::get('/select-plan/{plan_id}', [UserController::class,'selectPlan'])->name('select_plan');
Route::post('/select-addons', [UserController::class,'selectAddons'])->name('select_addons');
Route::get('/addons', [UserController::class,'addons'])->name('addons');
Route::get('/payment', [UserController::class,'payment'])->name('payment');


    Route::get('/dashboard', function () {

        $icountService = new \App\Services\IcountService();
        $user = auth()->user();

        if(!$user->is_admin){
            return Inertia::render('Dashboard');
        }

        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Admin routes for plan management
    Route::middleware(IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {
        Route::resource('plans', PlanController::class);
        Route::resource('addons', AddonController::class);
    });
});
