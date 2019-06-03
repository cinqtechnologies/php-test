@extends("skeleton")
@section("title", $product->name)

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{route("products")}}">Back to products</a>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                @if(isset($product->image_path))
                                    <img src="{{asset($product->image_path)}}" width="100%">
                                @else
                                    <h6>Image not found</h6>
                                @endif
                            </div>

                            <div class="col-md-10">
                                <h1 class="card-title">{{$product->name}} at $ {{$product->price}}</h1>
                                <h6 class="card-subtitle mb-2 text-muted">Retailer: <a href="{{route('retailer', ['id' => $product->retailer->id])}}"><strong>{{$product->retailer->name}}</strong></a></h6>
                                <p class="card-text">
                                    {{$product->description}}
                                </p>
                                <button type="button" class="btn btn-secondary" id="product_email">Send me details</button>
                                <a href="{{route('product-edit', ['id' => $product->id])}}" class="card-link float-right">Edit</a>

                                <div id="email_form" class="mt-3" style="display: none;">
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="staticEmail2" class="sr-only">Email</label>
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Type your e-mail">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Email</label>
                                            <input type="email" class="form-control" id="input_email" placeholder="email@example.com" autofocus required>
                                        </div>
                                        <button type="button" id="send_email" class="btn btn-primary mb-2">Enviar</button>
                                    </form>
                                </div>

                                <div id="email_sent" style="display: none" class="alert alert-warning fade show mt-3" role="alert">
                                    <strong>Success!</strong> You will receive more information soon.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
