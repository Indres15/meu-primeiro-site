@extends('layouts.app')


@section('content')
    <div class="row mb-2">
        <div class="col-12">
            <a href="{{ route('admin.notifications.read.all') }}" class="btn btn-lg btn-success">Marcar todas como lidas!</a>
            
        </div>
    </div>

    <table class='table table-striped'>
        <thead>
            <tr>
            
                <th>Notificação</th>
                <th>Criado em</th>
                <th>Ações</th>
                
            </tr>
        </thead>
        <tbody>
            
            @forelse ($unreadNotifications as $n)
                <tr>
                    <td>{{ $n->data['message'] }}</td>
                    <td>{{ $n->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.notifications.read', ['notification' => $n->id]) }}"
                                class="btn btn-sm btn-outline-primary">Marcar como lida</a>
                            {{-- <form action="{{ route('admin.products.destroy', ['product' => $p->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">REMOVER</button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-warning">Nenhuma notificação encontrada!</div>

                        </td>
                    </tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{ $products->links() }} --}}
@endsection
