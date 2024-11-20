<?php

use Inertia\Inertia;
use App\Models\Account;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/login',  [AuthController::class, 'index'])->name('login');
Route::post('dologin', [AuthController::class, 'doLogin'])
->name('dologin');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/',  [DashboardController::class, 'newindex'])->name('home');
    // Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard',  [DashboardController::class, 'newindex'])->name('dashboard');
    Route::get('/newdashboard',  [DashboardController::class, 'newindex'])->name('newdashboard');
    Route::get('/newaccounts', [AccountController::class, 'index'])->name('newaccounts');
    Route::get('/accounts',  [AccountController::class, 'newindex'])->name('accounts');

    Route::get('/newcontacts', [ContactController::class, 'newindex'])->name('newcontacts');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::get('/addcontact', [ContactController::class, 'showAddContact'])->name('addcontact');
    Route::get('/editcontact/{id}', [ContactController::class, 'showEditContact']);
    Route::get('/oldeditcontact/{id}', [ContactController::class, 'showOldEditContact']);
    Route::put('/submiteditcontact/{id}', [ContactController::class, 'submitEditContact']);
    Route::delete('/deletecontact/{id}', [ContactController::class, 'deleteContact']);
    Route::post('/submitaddcontact',[ ContactController::class, 'submitAddContact']);

    // Route::get('/newlogin',  [AuthController::class, 'index'])->name('newlogin');

    Route::get('/sellers', [SellerController::class, 'index'])->name('sellers');
    Route::get('/addseller', [SellerController::class, 'showAddSeller'])->name('addseller');
    Route::get('/editseller/{id}', [SellerController::class, 'showEditSeller']);
    Route::put('/submiteditseller/{id}', [SellerController::class, 'submitEditSeller']);
    Route::delete('/deleteseller/{id}', [SellerController::class, 'deleteSeller']);
    Route::post('/submitaddseller',[ SellerController::class, 'submitAddSeller']);

    Route::get('/newsellers', [SellerController::class, 'newindex'])->name('newsellers');

    Route::get('/viewprofile', [AuthController::class, 'profile'])->name('profile');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations');
    Route::get('/addlocation', [LocationController::class, 'showAddLocation'])->name('addlocation');
    Route::get('/editlocation/{id}', [LocationController::class, 'showNewEditLocation']);
    Route::get('/oldeditlocation/{id}', [LocationController::class, 'showEditLocation']);
    Route::put('/submiteditlocation/{id}', [LocationController::class, 'submitEditLocation']);
    Route::delete('/deletelocation/{id}', [LocationController::class, 'deleteLocation']);
    Route::post('/submitaddlocation',[ LocationController::class, 'submitAddLocation']);

    Route::get('/listlocations', [LocationController::class, 'newindex'])->name('newlocations');
    Route::get('/addnewlocation', [LocationController::class, 'showAddNewLocation'])->name('addnewlocation');





    Route::get('/deals', [DealController::class, 'index'])->name('deals');
    Route::get('/adddeal', [DealController::class, 'showAddDeal'])->name('adddeal');
    Route::get('/editdeal/{id}', [DealController::class, 'showEditDeal']);
    Route::put('/submiteditdeal/{id}', [DealController::class, 'submitEditDeal']);
    Route::delete('/deletedeal/{id}', [DealController::class, 'deleteDeal']);
    Route::post('/submitadddeal',[ DealController::class, 'submitAddDeal']);
    Route::get('/newdeals',  [DealController::class, 'newindex'])->name('newdeals');


    Route::get('/newcalls', [CallController::class, 'oldindex'])->name('calls');
    Route::get('/editcall/{id}', [CallController::class, 'showEditCall']);
    Route::put('/submiteditcall/{id}', [CallController::class, 'submitEditCall']);
    Route::delete('/deletecall/{id}', [CallController::class, 'deleteCall']);
    Route::post('/submitaddcall',[ CallController::class, 'submitAddCall']);
    Route::get('/calls',  [CallController::class, 'index'])->name('newcalls');

    Route::get('/newvisits', [VisitController::class, 'index'])->name('visits');
    Route::get('/addvisit', [VisitController::class, 'showAddVisit'])->name('addvisit');
    Route::get('/editvisit/{id}', [VisitController::class, 'showEditVisit']);
    Route::put('/submiteditvisit/{id}', [VisitController::class, 'submitEditVisit']);
    Route::delete('/deletevisit/{id}', [VisitController::class, 'deleteVisit']);
    Route::post('/submitaddvisit',[ VisitController::class, 'submitAddVisit']);

    Route::get('/visits', [VisitController::class, 'newindex'])->name('newvisits');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/addtask', [TaskController::class, 'showAddTask'])->name('addtask');
    Route::get('/edittask/{id}', [TaskController::class, 'showEditTask']);
    Route::put('/submitedittask/{id}', [TaskController::class, 'submitEditTask']);
    Route::delete('/deletetask/{id}', [TaskController::class, 'deleteTask']);
    Route::post('/submitaddtask',[ TaskController::class, 'submitAddTask']);

    Route::get('/newtasks', [TaskController::class, 'newindex'])->name('newtasks');

    Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings');
    Route::get('/addmeeting', [MeetingController::class, 'showAddMeeting'])->name('addmeeting');
    Route::get('/editmeeting/{id}', [MeetingController::class, 'showEditMeeting']);
    Route::put('/submiteditmeeting/{id}', [MeetingController::class, 'submitEditMeeting']);
    Route::delete('/deletemeeting/{id}', [MeetingController::class, 'deleteMeeting']);
    Route::post('/submitaddmeeting',[ MeetingController::class, 'submitAddMeeting']);
    Route::get('/newmeetings',  [MeetingController::class, 'newindex'])->name('newmeetings');


    Route::get('/addaccount', [AccountController::class, 'showAddAccount'])->name('addaccount');
    Route::get('/adddeal', [DealController::class, 'showAddDeal'])->name('adddeal');
    Route::get('/addcall', [CallController::class, 'showAddCall'])->name('addcall');
    Route::get('/editaccount/{id}', [AccountController::class, 'showEditAccount']);
    Route::put('/submiteditaccount/{id}', [AccountController::class, 'submitEditAccount']);
    Route::delete('/deleteaccount/{id}', [AccountController::class, 'deleteAccount']);
    Route::post('/submitaddaccount',[ AccountController::class, 'submitAddAccount']);


    Route::post('newlogout', [AuthController::class, 'destroy'])
    ->name('newlogout');

    




    Route::get('/accountstest', 
    function () {
        $accounts = Account::all();
        return Inertia::render('Dashboard',['accounts' => $accounts]);
    }
    )->name('accountstest');
    
    Route::get('/dashboardtest', 
    function () {
        return Inertia::render('DashboardTest');
    }
    )->name('dashboardtest');

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
