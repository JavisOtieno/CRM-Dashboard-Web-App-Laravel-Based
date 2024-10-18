<?php

use Inertia\Inertia;
use App\Models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CallController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeetingController;
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
    
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::get('/addcontact', [ContactController::class, 'showAddContact'])->name('addcontact');
    Route::get('/deals', [DealController::class, 'index'])->name('deals');

    Route::get('/calls', [CallController::class, 'index'])->name('calls');
    Route::get('/editcall/{id}', [CallController::class, 'showEditCall']);
    Route::put('/submiteditcall/{id}', [CallController::class, 'submitEditCall']);
    Route::delete('/deletecall/{id}', [CallController::class, 'deleteCall']);
    Route::post('/submitaddcall',[ CallController::class, 'submitAddCall']);

    Route::get('/visits', [VisitController::class, 'index'])->name('visits');
    Route::get('/addvisit', [VisitController::class, 'showAddVisit'])->name('addvisit');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/addtask', [TaskController::class, 'showAddTask'])->name('addtask');
    Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings');
    Route::get('/addmeeting', [MeetingController::class, 'showAddMeeting'])->name('addmeeting');
    Route::get('/addaccount', [AccountController::class, 'showAddAccount'])->name('addaccount');
    Route::get('/adddeal', [DealController::class, 'showAddDeal'])->name('adddeal');
    Route::get('/addcall', [CallController::class, 'showAddCall'])->name('addcall');
    Route::get('/editaccount/{id}', [AccountController::class, 'showEditAccount']);
    Route::put('/submiteditaccount/{id}', [AccountController::class, 'submitEditAccount']);
    Route::delete('/deleteaccount/{id}', [AccountController::class, 'deleteAccount']);
    Route::post('/submitaddaccount',[ AccountController::class, 'submitAddAccount']);
    Route::get('/accountstest', 
    function () {
        $accounts = Account::all();
        return Inertia::render('Dashboard',['accounts' => $accounts]);
    }
    )->name('accountstest');

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
