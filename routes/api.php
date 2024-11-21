<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CallController;
use App\Http\Controllers\api\DealController;
use App\Http\Controllers\api\LeadController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\VisitController;
use App\Http\Controllers\api\AccountController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\MeetingController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\ActivityController;
use App\Http\Controllers\api\LocationController;
use App\Http\Controllers\api\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('dashboard',[DashboardController::class,'index']);
Route::get('apitest',function(){
    // return "Test";
    $testStatus=array(
        "message" => "Test Successful",
        "status" => "success"
    );

    // $checkinStatus = $routeplanitem['outlet_id'];

    return response()->json($testStatus);
});

Route::post('/login', [AuthController::class, 'doLogin']);

Route::middleware(['auth:sanctum'])->group(function(){
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index']);

Route::get('/activities', [ActivityController::class, 'index']);
Route::post('/activitiesdate', [ActivityController::class, 'activitiesOnThisDate']);

Route::get('/accounts', [AccountController::class, 'index']);
Route::post('addaccount',[AccountController::class,'addAccount']);
Route::get('/account/{id}', [AccountController::class, 'showAccount']);
Route::get('/accountscontacts', [AccountController::class, 'accountsandcontacts']);
Route::get('/accountslocations', [AccountController::class, 'accountsandlocations']);

Route::get('/contacts', [ContactController::class, 'index']);
Route::post('addcontact',[ContactController::class,'addContact']);
Route::get('/contact/{id}', [ContactController::class, 'showContact']);

Route::get('/leads', [LeadController::class, 'index']);

Route::get('/locations', [LocationController::class, 'index']);
Route::post('addlocation',[LocationController::class,'addLocation']);
Route::get('/location/{id}', [LocationController::class, 'showLocation']);


Route::get('/deals', [DealController::class, 'index']);
Route::post('adddeal',[DealController::class,'addDeal']);
Route::get('/deal/{id}', [DealController::class, 'showDeal']);

Route::get('/calls', [CallController::class, 'index']);
Route::post('addcall',[CallController::class,'addCall']);
Route::get('/call/{id}', [CallController::class, 'showCall']);

Route::get('/meetings', [MeetingController::class, 'index']);
Route::post('addmeeting',[MeetingController::class,'addMeeting']);
Route::get('/meeting/{id}', [MeetingController::class, 'showMeeting']);

Route::get('/visits', [VisitController::class, 'index']);
Route::post('addvisit',[VisitController::class,'addVisit']);
Route::get('/visit/{id}', [VisitController::class, 'showVisit']);

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('addtask',[TaskController::class,'addTask']);
Route::get('/task/{id}', [TaskController::class, 'showTask']);

});


