@extends('layouts.front')


@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="" class="card-img-top">
            <div class="row">
                @foreach ($product->photos as $photo)
                    <div class="col-4">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-8">
            <h2>{{ $product->name }}</h2>
            <p>
                {{ $product->description }}
            </p>
            <h3>
                {{ $product->price }}
            </h3>

            <span>
                Loja: {{ $product->store->name }}
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{ $product->bory }}
        </div>
    </div>
@endsection