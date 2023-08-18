<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/requests', 'App\Http\Controllers\RequestHelpController@index')->name('request.index');

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    
    //Request
    Route::get('/create-request', 'App\Http\Controllers\RequestHelpController@create')->name('request.create');
    Route::post('/create-request', 'App\Http\Controllers\RequestHelpController@store')->name('request.store');
    Route::get('/requests/{requestHelp}/view', 'App\Http\Controllers\RequestHelpController@view')->name('request.view');
    Route::get('/my-request', 'App\Http\Controllers\RequestHelpController@myRequest')->name('request.my-request');
    Route::get('/my-request/{requestHelp}/view', 'App\Http\Controllers\RequestHelpController@myRequest_view')->name('request.my-request.view');
    Route::post('/my-request/update', 'App\Http\Controllers\RequestHelpController@update')->name('request.update');

    //Donate Request
    Route::post('/requests/view/donate-request', 'App\Http\Controllers\DonateRequestController@store')->name('donateRequest.store');
    Route::post('/my-request/view/mark-as-completed', 'App\Http\Controllers\DonateRequestController@markAsCompleted')->name('donateRequest.mark-as-completed');
    Route::post('/my-request/view/mark-as-recieved', 'App\Http\Controllers\DonateRequestController@markAsRecieved')->name('donateRequest.mark-as-recieved');
    Route::post('/my-request/view/mark-as-denied', 'App\Http\Controllers\DonateRequestController@markAsDenied')->name('donateRequest.mark-as-denied');
    
    //Profile
    Route::get('/profile', 'App\Http\Controllers\UserController@edit_profile')->name('profile');
    Route::post('/profile', 'App\Http\Controllers\UserController@update_profile')->name('profile.update');
});

//Auth Route for Organization | Admin | Superadmin
Route::group(['middleware' => ['auth', 'role:organization|admin|superadmin']], function () {
    //Camps
    Route::get('/camps', 'App\Http\Controllers\CampController@index')->name('camp.index');
    Route::get('/camp-create', 'App\Http\Controllers\CampController@create')->name('camp.create');
    Route::post('/camp-create', 'App\Http\Controllers\CampController@store')->name('camp.store');
    
    Route::get('/camp/{camp}/edit', 'App\Http\Controllers\CampController@edit')->name('camp.edit');
    Route::post('/camp/update', 'App\Http\Controllers\CampController@update')->name('camp.update');
    
});
