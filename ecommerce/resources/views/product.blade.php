@extends('layouts.store')

@push('scripts')
<script>
    window.__INITIAL_STATE = {!! json_encode($product) !!}
    console.log(window.__INITIAL_STATE)
</script>
<script src="{{ asset('js/product.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">

            <nav aria-label="breadcrumb mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                </ol>
            </nav>

            <div class="clearfix">
                <img :src="'/storage/'+product.image" class="rounded float-left" alt="Image">

                <div class="float-right">
                    <h4 class="h2 my-4" v-text="product.name"></h4>

                    <p><strong>$ @{{ product.price }}</strong></p>

                    <p class="text-primary" v-text="product.retailer.name"></p>

                    <div v-text="product.description" class="mb-4"></div>

                    <form @submit.prevent="sendEmail" class="mb-4">
                        <h5>Send the product details to your email:</h5>

                        <div v-if="showSuccess" class="alert alert-success mt-2" role="alert">
                            We've sent the product details do your email.
                        </div>

                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" v-model="form.email" required>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary" :disabled="loading">Send</button>
                    </form>
                </div>
            </div>
            <a href="/home" class="btn btn-outline-primary mt-4">Back</a>
        </div>
    </div>
@endsection