
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>My Store</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/album.css" rel="stylesheet">
  </head>
<body>
	<header>
		<div class="collapse bg-dark" id="navbarHeader">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-md-7 py-4">
						<h4 class="text-white">About</h4>
						<p class="text-muted">We sell auto parts, check the entire site for more information.</p>
					</div>
					<div class="col-sm-4 offset-md-1 py-4">
						<h4 class="text-white">Contact</h4>
						<ul class="list-unstyled">
							<li><a href="#" class="text-white">911-911-1119</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="navbar navbar-dark bg-dark shadow-sm">
			<div class="container d-flex justify-content-between">
				<a href="#" class="navbar-brand d-flex align-items-center">  <strong>My Store - {{$retailer->Name}}</strong>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarHeader" aria-controls="navbarHeader"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</div>
	</header>

	<main role="main">

	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Album example</h1>
			<img src="/imagens/retailersLogo/{{$retailer->LogoPath}}" class="rounded-circle" alt="Cinque Terre" style="max-width: 300px; max-height: 300px" />
			<p class="lead text-muted mt-3">Check below the availabe items.</p>
		</div>
	</section>

	<div class="album py-5 bg-light">
		<div class="container">

			<div class="row">
				@if(isset($produtos))
					@foreach($produtos as $produto)
        				<div class="col-md-4">
        					<div class="card mb-4 shadow-sm">
        						<img src="/imagens/productImages/{{$produto->ImagePath}}" class="bd-placeholder-img card-img-top" width="100%"
        							height="225" xmlns="http://www.w3.org/2000/svg"
        							preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
        						<!-- <svg class="bd-placeholder-img card-img-top" width="100%"
        							height="225" xmlns="http://www.w3.org/2000/svg"
        							preserveAspectRatio="xMidYMid slice" focusable="false" role="img"
        							aria-label="Placeholder: Thumbnail"> -->
        							<title>Placeholder</title><rect width="100%" height="100%"
        								fill="#55595c" />
        							<!-- <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
        						<div class="card-body">
        							<p class="card-text">{{$produto->Description}}
        							<h3>Price: ${{$produto->Price}}</h3>        							
        							</p>
        							<div class="d-flex justify-content-between align-items-center">
        								<div class="btn-group">
        								<a class="btn btn-sm btn-outline-secondary" href="{{route('store.productDetail',['idProduct' => $produto->id])}}">Details</a>
        									<!-- <button type="button" class="btn btn-sm btn-outline-secondary">Details</button> -->
        								</div>
        								<!-- <small class="text-muted">9 mins</small> -->
        							</div>
        						</div>
        					</div>
        				</div>
        			@endforeach
				@endif
			</div>
		</div>
	</div>

	</main>

	<footer class="text-muted">
		<div class="container">
			<p class="float-right">
				<a href="#">Back to top</a>
			</p>
			<p>Album example is &copy; Bootstrap, but please download and
				customize it for yourself!</p>
			<p>
				New to Bootstrap? <a href="https://getbootstrap.com/">Visit the
					homepage</a> or read our <a
					href="/docs/4.3/getting-started/introduction/">getting started
					guide</a>.
			</p>
		</div>
	</footer>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="/sbAdmin/js/sb-admin.js" type="text/javascript"></script>

	<!-- Bootstrap core JavaScript-->
	<script src="/sbAdmin/vendor/jquery/jquery.min.js"></script>
	<script src="/sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="/sbAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Page level plugin JavaScript-->
	<script src="/sbAdmin/vendor/chart.js/Chart.min.js"></script>
	<script src="/sbAdmin/vendor/datatables/jquery.dataTables.js"></script>
	<script src="/sbAdmin/vendor/datatables/dataTables.bootstrap4.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="/sbAdmin/js/sb-admin.min.js"></script>

	<!-- Demo scripts for this page-->
	<script src="/sbAdmin/js/demo/datatables-demo.js"></script>
	<script src="/sbAdmin/js/demo/chart-area-demo.js"></script>
	
	<!-- jquery.Mask-->
	<script src="/js/jquery.mask.js"></script>
	<script src="/js/masks.js"></script>
</body>
</html>
