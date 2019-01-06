@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">

                        <h4 class="card-title">Add Product</h4>

                        @if (session('success'))
                            <div class="alert alert-success my-4 alert-dismissible fade show" role="alert">
                                {!! session('success') !!} <a href="{{ route('home') }}" class="alert-link">Go to the store</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label>Retailer</label>
                                <select
                                    name="retailer_id"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    required autofocus
                                >
                                    <option></option>
                                    @foreach($retailers as $retailer)
                                    <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input
                                        type="text"
                                        name="name"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        value="{{ old('name') }}"
                                        required
                                >
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea
                                        name="description"
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        rows="3"
                                        required>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input
                                        type="text"
                                        name="website"
                                        class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                        value="{{ old('price') }}"
                                        required>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input
                                        type="file"
                                        name="image"
                                        class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                        value="{{ old('image') }}"
                                        required>

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary mb-4">Back</a>
            </div>
        </div>
    </div>
@endsection