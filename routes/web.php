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

 //  $user = new \App\User();
 //   $user = \App\User::find(41);
 //  $user ->name ='Teste';
 //  $user ->email ='email@teste.com';
 //  $user ->password = bcrypt('12345678');

 //  $user->save();
    //return $user->save();
    // \App\User::all(); - retorna todas os Usuarios
    //  \App\User::find(5); - retorna o usuario com base no id
    // \App\User::where('name', 'Amaya Grady')->get(); //select * from users where name = Amaya Grady
    // \App\User::where('name', 'Amaya Grady')->first(); //select * from users where name = Amaya Grady
    // \App\User::paginate(10); - paginar dados com o laravel

      return;
});
