<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SbAdmin</title>

<!-- Custom fonts for this template-->
<link href="/sbAdmin/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="/sbAdmin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link rel="stylesheet" href="/sbAdmin/css/sb-admin.css" />
</head>
<body id="page-top">
    <section class="barranav">
        @include('tema.navbar')
    </section>
    <div id="wrapper">
     	@include('tema.sidebar')     	
     	<div id="content-wrapper">
          <div class="container-fluid">
          	@yield('conteudo')
          </div>
      </div>
    </div>
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