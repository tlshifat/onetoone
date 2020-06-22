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

//one to many
Route::get('/create', function () {
    $user = \App\User::find(1);
    $post = new \App\Post(["name"=>"CTG"]);

    return $user->posts()->save($post);
});


Route::get('/reads', function () {
    $user = \App\User::find(1);
    return $user->posts;
});

Route::get('/updates', function () {
    $user = \App\User::find(1);
    return $user->posts()->whereId(1)->save(new \App\Post(['name'=>'updated post']));

});

Route::get('/deletes', function () {
    $user = \App\User::find(1);
    return $user->posts()->whereId(1)->delete();

});


//many to many pivot table
Route::get('/create_many', function () {
    $user = \App\User::find(1);
    return $user->roles()->save(new \App\Role(['name'=>'sub']));
});

//many to many pivot table
Route::get('/update_many', function () {
    $user = \App\User::find(1);
    foreach ($user->roles as $role){
        $role->name = "sb";
        $role->save();
    }
});


//many to many pivot table
Route::get('/read_many', function () {
    $user = \App\User::find(1);
    return $user->roles;
});

//many to many pivot table
Route::get('/delete_many', function () {
    $user = \App\User::find(1);
    return $user->roles()->delete();
});


//many to many pivot table
Route::get('/attach_many', function () {
    $user = \App\User::find(1);
    return $user->roles()->attach([1]);
});

//many to many pivot table
Route::get('/detach_many', function () {
    $user = \App\User::find(1);
    return $user->roles()->detach([1]);
});


//many to many pivot table
Route::get('/sync_many', function () {
    $user = \App\User::find(1);
    return $user->roles()->sync([1,2,3]);
});


//polymorphic from staff to photo and production to photo
Route::get('/createp',function (){
    //$user = \App\Staff::create(['name'=>'Staff 1']);
    //$user = \App\Product::create(['name'=>'Product 1']);
    $staff = \App\Staff::findOrFail(1);
    $staff->photos()->save(new \App\Photo(['path'=>'staff.photo']));

});

//polymorphic from staff to photo and production to photo
Route::get('/readp',function (){
    //$user = \App\Staff::create(['name'=>'Staff 1']);
    //$user = \App\Product::create(['name'=>'Product 1']);
    $staff = \App\Staff::findOrFail(1);
    return $staff->photos;

});


//polymorphic from staff to photo and production to photo
Route::get('/updatep',function (){
    //$user = \App\Staff::create(['name'=>'Staff 1']);
    //$user = \App\Product::create(['name'=>'Product 1']);
    $staff = \App\Staff::findOrFail(1);
    $photo= $staff->photos()->whereId(1)->first();
    $photo->path= 'updated photo.photo';
    return $photo->save();
});

//polymorphic from staff to photo and production to photo
Route::get('/deletep',function (){
    //$user = \App\Staff::create(['name'=>'Staff 1']);
    //$user = \App\Product::create(['name'=>'Product 1']);
    $staff = \App\Staff::findOrFail(1);
    return $staff->photos()->whereId(1)->delete();
});

