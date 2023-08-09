<table>
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
            <td></td>

        </tr>
        @endforeach
    </body>
</table>

{{$stores->links()}}