<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\User;

class StoreController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product, $id)
    {
        //
    }

    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        if(auth()->user()->store()->count()) {
            flash('Você já possui uma loja') warning();
            return redirect()->route('admin.stores.index');

        }

        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = User::find(auth()->id());   // $user auth()->user();
        $store = $user->store()->create($data);

        flash('Loja Criada com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $data = ($request->all());

        $store = \App\Store::find($store);
        $store->update($data);

        flash('Loja Atualizada com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();


        flash('Loja Removida com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
