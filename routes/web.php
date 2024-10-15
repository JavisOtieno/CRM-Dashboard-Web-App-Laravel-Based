<?php

use Inertia\Inertia;
use App\Models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ProfileController;

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



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts');
    Route::get('/deals', [DealController::class, 'index'])->name('deals');
    Route::get('/addaccount', [AccountController::class, 'showAddAccount'])->name('addaccount');
    Route::get('/editaccount/{id}', [AccountController::class, 'showEditAccount']);
    Route::put('/submiteditaccount/{id}', [AccountController::class, 'submitEditAccount']);
    Route::delete('/deleteaccount/{id}', [AccountController::class, 'deleteAccount']);
    Route::post('/submitaddaccount',[ AccountController::class, 'submitAddAccount']);
    Route::get('/accountstest', 
    function () {
        $accounts = Account::all();
        return Inertia::render('Dashboard',['accounts' => $accounts]);
    }
    )->name('accounts');

    Route::get('/customers', 
    function () {
        $accounts = Account::all();
        return Inertia::render('Customers',['accounts' => $accounts]);
    }
    )->name('customers');
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
