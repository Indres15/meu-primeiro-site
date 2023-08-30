@extends('layouts.app')
''

@section('content')
    {{-- <a href="{{ route('admin.category.create') }}" class="btn btn-lg btn-success">Criar Categoria</a> --}}

    <table class='table table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>

        <body>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                class="btn btn-sm btn-outline-primary">EDITAR</a>
                            <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
                                method="post">
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

    {{ $categories->links() }}
@endsection
