@extends('layouts.app')

@section('content')
<h1>Criar Produto</h1>
<form action="{{ route('admin.products.store') }}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
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
        <input type="text" name="price" class="form-control" value="{{$product->price}}">
    </div>

    <div  class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
    </div>

    <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
    </div>
</div>
</form>
@endsection
