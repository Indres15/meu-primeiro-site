<?php

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

use App\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/model', function() {

   // $Products = Product::all(); //select * from products

   $user = new \App\User();
   $user ->name ='Teste';
   $user ->email ='email@teste.com';
   $user ->password = bcrypt('12345678');

    //return $user->save();

    return \App\User::all();
});
