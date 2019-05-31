@extends('layouts.app')

@section('title', 'CINQ - Product')

@section('content')

<div class="container">
    <hr />
    <div class="row">
       <h1>Product - {{ $product->name }}</h1>
    </div>
    <hr />
        <div class="row">
                <div class="col-sm-6 col-md-6 col-xs-12 image-container">
                    <img src="{{ config('filesystems.disks.public.products') }}/{{ $product->file_pic }}" class="card-img-top" alt="">
                </div>
                <div class="col-sm-6 col-md-6 col-xs-12">
                    <p>{{ $product->name }}</p>
                    <p>{{ $product->description }}</p>
                    <p>R$ {{ $product->price }}</p>
                    <p><a href="{{ route("retailer.show", ["id" => $product->retailer_id] )}}">{{ $product->retailers->name }}</a></p>
                    <p>E-mail: <input type="text" class="form-control"/></p>
                    <p><a href="/" role="button" class="btn btn-primary btn-lg">
                        Let me know when this product is available
                        </a>:
                    </p>
                </div>
        </div>
    <hr />
        <div class="row">
            <a href="/" role="button" class="btn btn-primary btn-lg">
                Voltar
            </a>
        </div>
</div>
@endsection
