@extends("skeleton")
@section("title", 'Product')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="d-inline-block">@if(isset($product)) Edit @else New @endif product</h1>

                <form enctype="multipart/form-data" method="post" id="new-product-form" action="{{route('product-update', ['id' => isset($id)? $id : false])}}">
                    @csrf
                    <div class="form-group">
                        <label for="product-name">Product image</label>
                        @if(isset($product->image_path))
                            <img src="{{asset($product->image_path)}}" width="10%" class="d-block mb-2">
                        @endif
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="product-name">Product name</label>
                        <input type="text" name="name" class="form-control" value="@if(isset($product->name)){{$product->name}}@endif" id="product-name" placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label for="product-name">Product description</label>
                        <textarea class="form-control" name="description" id="product-description">@if(isset($product->description)){{$product->description}}@endif</textarea>
                    </div>

                    <div class="form-group">
                        <label for="product-price">Product price</label>
                        <input type="number" name="price" class="form-control" id="product-price" value="@if(isset($product->price)){{$product->price}}@endif" placeholder="Price" required>
                    </div>

                    <div class="form-group">
                        <label for="product-price">Product retailer</label>
                        <select class="form-control" name="retailer_id" id="product-retailer" required>
                            @foreach($retailers as $retailer)
                                <option value="{{$retailer->id}}" @if(isset($product->retailer->id) && $product->retailer->id === $retailer->id) selected @endif>{{$retailer->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </main>
@endsection
