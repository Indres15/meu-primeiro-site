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

    //Mas Assigment - Atribuição em massa

      // return \App\User::create([
      //   'name' =>'Fernanda indres',
      //   'email' =>'email112@teste.com',
      //   'password' => bcrypt('12345678')

      // ]);
      // add($user);

      //mas Update
      // $user =  \App\User::find(43);
      // $user->update([
      //     'name' => 'atualzando com Mass Update'
      // ]); //true ou false

      //como fazer para pegar a loja de um usuário
      //$user =  \App\User::find()

      //dd($user->store()->count()); //o objeto único (store) se for collection de dados (objeto)

      //pegar os produtos de uma loja?

      // $loja = \App\Store::find(1);

      // return $loja->products; / &loja->products()->where('id', 9)->get();

  //pegar as lojas de uma categoria de uma loja?
      // $categoria = \App\Category::find(1);
      // $categoria->products;

  //criar uma loja para um usário
      // $user = \App\User::find (10);
      // $store = $user->store()->create([
      //   'name' => 'loja teste',
      //   'description' => 'loja tetse de produto de informatica',
      //   'mobile_phone' => 'xx-xxxxx-xxxx',
      //   'phone' => 'xx-xxxxx-xxxx',
      //   'slug' => 'loja-teste',
      // ]);

      // dd($store);

  //Criar u produti para uma loja
      // $store = \App\Store::find(50);
      // $product = $store->products()->create([
      //   'name' => 'notebook dell',
      //   'description' => 'CORE i5 10GB',
      //   'bory' =>'qualquer coisa...',
      //   'price' =>2999.90,
      //   'slug' => 'notebook-dell',

      // ]);

      // dd($product);

  //criar uma categoria

    //  \App\Category::create([
    //     'name' => 'Game',
    //     'slug' => 'Games'
    //  ]);

    //    \App\Category::create([
    //   'name' => 'Notebooks',
    //   'slug' => 'Notebooks'
    //   ]);

    //     return \App\Category::all();

  //Adicionar um produto para uma categoria ou vice-versa

    //   dd($product->categories()->sync([2]));

        $product = \App\Product::find(1);

        return $product->categories;

      //return \App\User::all();

});



route::prefix('admin')->namespace('Admin')->group(function(){

  route::prefix('stores')->group(function(){
    Route::get('/', 'StoreController@index');
    Route::get('/create', 'StoreController@create');
    Route::post('/store', 'StoreController@store');
  });

});






