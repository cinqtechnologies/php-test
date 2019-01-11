<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<title>E-commerce</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-2 margin-tb">
			<div class="text-left">
            	<a class="btn btn-success" href="<?php echo base_url('/app') ?>"> Home</a>
        	</div>
		</div>
    	<div class="col-lg-10 margin-tb">
	        <div class="text-right">
	            <a class="btn btn-success" href="<?php echo base_url('app/create-product') ?>"> Add product</a>
	            <a class="btn btn-success" href="<?php echo base_url('app/create-retailer') ?>">Add retailer</a>
	        </div>
	    </div>
	</div>
	<br />