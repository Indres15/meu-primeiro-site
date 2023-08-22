@extends('layouts.app')


@section('content')
<a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar Loja</a>

<table class='table table-striped'>
    <thead>
        <tr>
            <th>#</th>
            <th>loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <body>
        @foreach ($stores as $store )
        <tr>
            <td>{{$store->id}}</td>
            <td>{{$store->name}}</td>
            <td>
                <div class="btn-group">

                    <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-outline-primary">EDITAR</a>   
                    <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="post">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-sm btn-outline-danger">REMOVER</button> 
                     </form>
                </div>
            </td> 
        </tr>
        @endforeach
    </body>
</table>

{{$stores->links()}}
@endsection
