@extends('layouts.front')


@section('content')
    <div class="row">
        <div class="col-4">
            @if ($product->photos->count())
                <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="" class="card-img-top">
                <div class="row" style="margin-top: 20px;">
                    @foreach ($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            @else  
                <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="" class="card-img-top"> 
            @endif
        </div>
        <div class="col-6">
            <div class="col-md-12">

                <h2>{{ $product->name }}</h2>

                <p>
                    {{ $product->description }}
                </p>

                <h3>
                R$ {{number_format($product->price, '2', ',', '.') }}
                </h3>

                <span>
                    Loja: {{ $product->store->name }}
                </span>
            </div>

            <div class="product-add col-md-12">
                <hr>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label>Quantidade</label>
                        <input type="number" class="form-control col-md-2">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{ $product->bory }}
        </div>
    </div>
@endsection