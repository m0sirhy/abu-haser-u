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


    Route::get('/consume', function () {
        return view('entry.index');
    })->middleware('auth','permission:read_consume')->name('consume');;

    // Route::post('/map', function (Request $request) {
    //     $lat = $request->input('lat');
    //     $long = $request->input('long');
    //     $location = ["lat"=>$lat, "long"=>$long];
    //     event(new SendLocation($location));
    //     return response()->json(['status'=>'success', 'data'=>$location]);
    // });


    Auth::routes(['register' => false ,'password.request' => false, 'password.reset' => false]);
    Route::post('/push','PushController@store');
    Route::get('/push','PushController@push')->name('push'); 
Route::group(
    [
        'namespace' => 'Employee',
        'prefix' => 'Employee',
    ] , function() {
    Route::resource('Employee' , 'EmployeeController');
    Route::post('Employee/{id}/update' , 'EmployeeController@update')->name('Employee.update');
});
