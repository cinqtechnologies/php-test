@extends('layouts.app')

@section('title', 'CINQ - New Product')

@section('content')

<hr />
<div class="container">
    <div class="row">
    <h1>New Product</h1>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" role="form" action="/createproduct" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" name="price">
                </div>
                <label>Product Image</label>
                <div class="custom-file">

                        <input type="file" class="custom-file-input" id="file_pic" name="file_pic">
                        <label class="custom-file-label" for="file_pic">Choose file</label>
                </div>
                <hr />
                <div class="form-group">
                        <label for="retailer_id">Retailer Name:</label>
                        <select name="retailer_id" id="retailer_id" class="form-control">
                            <option> - Select a Retailer - </option>
                            @foreach ($retailers as $retailer)
                                <option value="{{$retailer->id}}">{{$retailer->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="descrption" id="description" class="form-control">
                        </textarea>
                </div>
                <div class="form-group">
                        <input type="submit"  class="btn btn-primary btn-lg" name="register" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
