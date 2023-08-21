@extends('layouts.app')


@section('content')
<a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>

<table class='table table-striped'>
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
        
            <th>Ações</th>
        </tr>
    </thead>
    <body>
        @foreach ($products as $p )
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>
            <td>
               <a href="{{route('admin.products.edit', ['product' => $p->id])}}" class="btn btn-outline-primary">EDITAR</a> 
               <form action="{{route('admin.products.destroy', ['product' => $p->id])}}"></form>
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-sm btn-outline-danger">REMOVER</button>  
            </td> 
        </tr>
        @endforeach
    </body>
</table>

{{$products->links()}}
@endsection
