@extends('layouts.front')


@section('content')
    @foreach ($products as $product)
        <div class="card">
            @if ()
                
            @endif
            <div class="card-body">
                <h2 class="card-litle">{{ /4product->name }}</h2>
                <p class="card-text">
                    {{ product->description }}
                </p>
            </div>
        </div>   
    @endforeach

@endsection 
