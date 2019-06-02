@extends("skeleton")
@section("title", 'Retailers')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="d-inline-block">Retailers</h1>
                <a href="{{route('retailer-new')}}" class="btn btn-primary float-right m-1">Add new</a>
                <a class="d-block" href="{{route('products')}}">Go to products</a>
                @if(count($retailers) > 0)
                <div class="list-group">
                    @foreach($retailers as $retailer)
                        <a href="{{route('retailer', ['id' => $retailer->id])}}" class="list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col-md-2">
                                    @if(isset($retailer->image_path))
                                        <img src="{{asset($retailer->image_path)}}" width="100%">
                                    @else
                                        <h6>Image not found</h6>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$retailer->name}}</h5>
                                    </div>
                                    <p class="mb-1">{{$retailer->description}}</p>
                                    <small>Visite our website <strong>{{$retailer->website}}</strong></small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                @else
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="card-title">No retailers registered</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
