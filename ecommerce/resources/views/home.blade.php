@extends('layouts.store')

@push('styles')
<link href="{{ asset(mix('css/home.css')) }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/products.js') }}" defer></script>
@endpush

@section('content')
    <div class="row" v-if="showRetailerDetails">
        <div class="col-12">
            <div class="card text-white bg-info mb-4">
                <div class="card-header">Retailer Details</div>
                <div class="card-body">
                    <img :src="'/storage/'+retailer.logo" class="rounded float-left img-thumbnail mr-3 mb-3" alt="Logo">
                    <div>
                        <h4 class="card-title" v-text="retailer.name"></h4>
                        <p class="card-text" v-text="retailer.description"></p>

                        <div class="clearfix">
                            <div class="float-md-left">
                                <a :href="'http://'+retailer.website" class="btn btn-primary" target="_blank">Website</a>
                            </div>
                            <a @click.prevent="dismissRetailerFilter" href="#" class="float-md-right btn btn-lg btn-outline-light">Back</a>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <h2 class="h2 my-4" v-text="labelProducts"></h2>

            <div v-if="totalProducts == 0" class="alert alert-warning" role="alert">
                No product found
            </div>

            <div v-else>
                <div class="card-columns">
                    <div v-for="product in products" class="card p-3">
                        <img class="card-img-top" :src="'/storage/'+product.image" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title" v-text="product.name"></h5>
                            <p><strong>$ @{{ product.price }}</strong></p>
                            <p>
                                <a href="#" v-text="product.retailer.name" @click.prevent="productsByRetailer(product.retailer_id)"></a>
                            </p>
                            <p v-text="product.description" class="card-text"></p>

                            <a :href="'product/'+product.id" class="btn btn-sm btn-outline-primary">Detalhes</a>
                        </div>
                    </div>
                </div>

                <nav v-if="totalProducts > 0">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection