@extends('layouts.app')


@section('content')
    <a href="#" class="btn btn-lg btn-success">Marcar todas como lidas!</a>

    <table class='table table-striped'>
        <thead>
            <tr>
            
                <th>Notificação</th>
                <th>Criado em</th>
                <th>Ações</th>
                
            </tr>
        </thead>
        <tbody>
            
            @foreach ($unreadNotifications as $n)
                <tr>
                    <td>{{ $n->data['message'] }}</td>
                    <td>{{ $n->createdAt }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#"
                                class="btn btn-sm btn-outline-primary">Marcar como lida</a>
                            {{-- <form action="{{ route('admin.products.destroy', ['product' => $p->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">REMOVER</button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $products->links() }} --}}
@endsection
