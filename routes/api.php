<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::group(['middleware' => 'api'], function(){
	Route::get('contacts', function(){
		return  DB::table('contacts')->orderBy('created_at', 'desc')->get();
	});

	Route::get('contact/{id}', function($id){
		return (DB::table('contacts')->find($id));
	});

	Route::post('contact/store', function(Request $request){
		$contact = new Contact();
		$contact->name = $request->name;
		$contact->email = $request->email;
		$contact->phone = $request->phone;
		$contact->save();
	});
});