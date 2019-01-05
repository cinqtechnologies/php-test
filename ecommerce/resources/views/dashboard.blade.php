@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>

                    <br>

                    <a href="{{ route('retailer.create') }}" class="btn btn-primary mb-4">Add Retailer</a>
                    <a href="{{ route('product.create') }}" class="btn btn-primary mb-4">Add Product</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary mb-4">Go back to the store</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
