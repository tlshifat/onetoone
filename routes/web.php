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

Route::get('/', function () {
    return view('welcome');
});


//One to one relationship CRUD

Route::get('/insert', function () {
    $user = \App\User::find(1);
    $address = new \App\Address(["address"=>"CTG"]);

    return $user->address()->save($address);
});

Route::get('/update', function () {
    $address = \App\Address::whereUserId(1)->first();
    $address->address="Updated name ";

    return $address->save();
});

Route::get('/read', function () {
    $user = \App\User::whereId(1)->first();
    $address = $user->address->address;
    return $address;
});


Route::get('/delete', function () {
    $user = \App\User::whereId(1)->first();
    $address = $user->address()->delete();
    return $address;
});

