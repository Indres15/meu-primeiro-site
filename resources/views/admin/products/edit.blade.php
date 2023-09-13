@extends('layouts.app')

@section('content')
    <h1>Atualizar Produto</h1>
    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control" value="{{ $product->description }}">
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="bory" id="" cols="30" rows="10" class="form-control">{{ $product->bory }}</textarea>
        </div>

        <div class="form-group">
            <label>preço</label>
            <input type="text" name="price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label>Categorias</label>
            <select name="categories[]" id="" class="form-control" multiple>
                @foreach ($categories as $category)

                    <option value="{{ $category->id }}" 
                        @if ($product->categories->contains($category)) selected @endif
                        >{{ $category->name }}</option> 
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control" multiple>
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
        </div>

        <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>

    </form>

    <div class="row">
        @foreach ($product->photos as $photo)
            <div class="col-4">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">
            </div>
        @endforeach
    </div>
@endsection
