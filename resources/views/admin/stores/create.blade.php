@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="/admin/stores/store" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group>
            <label>Nome Loja</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group>
            <label>Descrição</label>
            <input type="text" name="description" class="form-control">
        </div>

        <div class="form-group>
            <label>Telefone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="form-group>
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control">
        </div>

        <div class="form-group>
            <label>Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>

        <div class="form-group>
            <label>Usuário</label>
            <select name="user">
                @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        <div>
        <button type="submit"> Criar loja</button>
        </div>
    </div>
</form>
@endsection
