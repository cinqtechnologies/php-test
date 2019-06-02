@extends("skeleton")
@section("title", 'Retailer')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="d-inline-block">New retailer</h1>

                <form enctype="multipart/form-data" method="post" id="new-retailer-form" action="{{route('retailer-update', ['id' => isset($id)? $id : false])}}">
                    @csrf
                    <div class="form-group">
                        <label for="retailer-image">Retailer image</label>
                        @if(isset($retailer->image_path))
                            <img src="{{asset($retailer->image_path)}}" width="10%" class="d-block mb-2">
                        @endif
                        <input type="file" id="retailer-image" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="product-name">Retailer name</label>
                        <input type="text" name="name" class="form-control" value="@if(isset($retailer->name)){{$retailer->name}}@endif" id="retailer-name" placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label for="product-name">Retailer description</label>
                        <textarea class="form-control" name="description" id="retailer-description">@if(isset($retailer->description)){{$retailer->description}}@endif</textarea>
                    </div>

                    <div class="form-group">
                        <label for="product-price">Retailer website</label>
                        <input type="text" name="website" class="form-control" id="retailer-website" value="@if(isset($retailer->website)){{$retailer->website}}@endif" placeholder="Website" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </main>
@endsection
