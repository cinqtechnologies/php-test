<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'App') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
        <link href="{{ asset(mix('css/home.css')) }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/products.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <a class="navbar-brand" href="#">{{ config('app.name', 'App') }}</a>
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            @auth
                            <a class="nav-item nav-link active" href="{{ url('/dashboard') }}">Home</a>
                            @else
                                <a  class="nav-item nav-link"href="{{ route('login') }}">Login</a>

                                <a  class="nav-item nav-link"href="{{ route('register') }}">Register</a>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container">

                @include('partials.loading')

                <div v-show="!pageLoading" id="main-content" style="display: none">
                    <div class="row" v-if="showRetailerDetails">
                        <div class="col-12">
                            <div class="card text-white bg-info mb-4">
                                <div class="card-header">Retailer Details</div>
                                <div class="card-body">
                                    <img :src="'/storage/'+retailer.logo" class="rounded float-left img-thumbnail mr-3 mb-3" alt="Logo">
                                    <div>
                                        <h4 class="card-title" v-text="retailer.name"></h4>
                                        <p class="card-text" v-text="retailer.description"></p>
                                        <div class="text-right">
                                            <a @click.prevent="dismissRetailerFilter" href="#" class="btn btn-outline-light">Back</a>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <p class="h2 my-4" v-text="labelProducts"></p>

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

                                            <button type="button" class="btn btn-sm btn-outline-primary">Detalhes</button>
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
                </div>
            </div>
        </div>
    </body>
</html>
