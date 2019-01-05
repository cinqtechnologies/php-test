@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">

                        <h4 class="card-title">Add Retailer</h4>

                        <div class="alert alert-success my-4 alert-dismissible fade show" role="alert">
                            The retailer data was saved! <a href="{{ route('home') }}" class="alert-link">Go to the store</a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" class="form-control-file">
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