@extends('layouts.app')


@section('content')
    <h1>Criar Produto</h1>
    <form action="{{ route('admin.products.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Nome Loja</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control">
        </div>

        <div class="form-group">
            <label>Cnteúdo</label>
            <textarea name="bory" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>preço</label>
            <input type="text" name="price" class="form-control">
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="form-group">
            <label>Loja</label>
            <select name="store">
                @foreach($stores as $store)
            <option value="{{$store->id}}">{{$store->name}}</option>
                @endforeach
            </select>
        <div>
        <button type="submit" class="btn btn-lg btn-success">Criar Produto</button>
        </div>
    </div>
</form>
@endsection
