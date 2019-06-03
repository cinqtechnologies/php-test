@extends("skeleton")
@section("title", 'Products')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="d-inline-block">Products</h1>
                <a href="{{route('product-new')}}" class="btn btn-primary float-right m-1">Add new</a>
                <a class="d-block" href="{{route('retailers')}}">Go to retailers</a>
                @if(count($products) > 0)
                <div class="list-group">
                    @foreach($products as $product)
                            <a href="{{route('product', ['id' => $product->id])}}" class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-md-2">
                                        @if(isset($product->image_path))
                                            <img src="{{asset($product->image_path)}}" width="100%">
                                        @else
                                            <h6>Image not found</h6>
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{$product->name}}</h5>
                                                <small>$ {{$product->price}}</small>
                                            </div>
                                            <p class="mb-1">{{$product->description}}</p>
                                    </div>
                                </div>
                            </a>
                    @endforeach
                </div>
                @else
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="card-title">No products registered</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
