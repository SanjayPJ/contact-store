<?php

use Illuminate\Http\Request;
use App\Contact;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::get('contacts', function(){
	return Contact::orderBy('created_at','desc')->get();
});

Route::get('contact/{id}', function($id){
	return Contact::findOrFail($id);
});

Route::post('contact/store', function(Request $request){
	$request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
    ]);
	return Contact::create(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone]);
});

Route::patch('contact/{id}', function(Request $request, $id){
	$request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
    ]);
    Contact::findOrFail($id)->update(['name' => $request->input(['name']), 'email' => $request->input(['email']), 'phone' => $request->input(['phone'])]);
    return Contact::findOrFail($id);
});

Route::delete('contact/{id}', function($id){
	return Contact::destroy($id);
});