@extends("skeleton")
@section("title", $retailer->name)

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{route('retailers')}}">Back to retailers</a>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                @if(isset($retailer->image_path))
                                    <img src="{{asset($retailer->image_path)}}" width="100%">
                                @else
                                    <h6>Image not found</h6>
                                @endif
                            </div>

                            <div class="col-md-10">
                                <h1 class="card-title">{{$retailer->name}}</h1>
                                <h6 class="card-subtitle mb-2 text-muted"><strong><a target="_blank" href="http://{{$retailer->website}}">{{$retailer->website}}</a></strong></h6>
                                <p class="card-text">
                                    {{$retailer->description}}
                                </p>
                                <a href="{{route('retailer-edit', ['id' => $retailer->id])}}" class="card-link">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Products</h3>
                @if(count($products) > 0)
                <div class="list-group">
                    @foreach($products as $product)
                        <a href="{{route('product', ['id' => $product->id])}}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$product->name}}</h5>
                                <small>$ {{$product->price}}</small>
                            </div>
                            <p class="mb-1">{{$product->description}}</p>
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
