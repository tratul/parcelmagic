<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;

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
    return view('login');
});

// Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'Login'])->name('login.post'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('campaign', [CampaignController::class, 'index'])->name('campaign.list'); 
Route::get('campaign/create', [CampaignController::class, 'create'])->name('campaign.create'); 
Route::post('campaign/create', [CampaignController::class, 'store'])->name('campaign.store');
Route::get('campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');  
Route::post('campaign/edit/{id}', [CampaignController::class, 'update'])->name('campaign.update');  
