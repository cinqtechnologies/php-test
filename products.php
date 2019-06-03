<?php
	require_once "lib/config.php";

	$products = null;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "products/read.php");
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, API_SECURE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($curl);

	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ($temp = curl_error($curl)) {
		$result = json_decode($result);
		echo $result->message;
		curl_close ($curl);
		exit();
	}
	else if ($httpCode >= 300) {
		$result = json_decode($result);
		echo $result->message;
		exit();
	}

	$products = json_decode($result);
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "templates/head.php"; ?>
	<?php require_once "templates/stylesheets.php"; ?>
</head>
<body>
	<?php require_once "templates/header.php"; ?>

	<section class="mx-2 my-3">
		<div class="container box">
			<div class="section-title">
				<a href="edit_product.php" class="btn btn-primary float-right">New product</a>
				<h2 class="mb-3">Products</h2>
				
				<div class="clearfix"></div>
			</div>

			<div class="d-flex flex-wrap justify-content-center">
			<?php foreach ($products as $product) { ?>
				<div class="thumb">
					<a href="product.php?id=<?php echo $product->id; ?>">
						<div class="product-image mb-1" <?php if ( !empty($product->image) ) { ?> style="background-image: url(<?php echo $product->image; ?>);" <?php }?>></div>
					</a>
					<div class="descricao">
						<a href="product.php?id=<?php echo $product->id; ?>">
							<h3 class="mt-1"><?php echo $product->name; ?></h3>
						</a>
						<small><a href="product.php?id=<?php echo $product->id; ?>"><?php echo "R$ " . number_format($product->price, 2, ".", ","); ?></a></small>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</section>

	<?php require_once "templates/footer.php"; ?>
	<?php require_once "templates/scripts.php"; ?>
	<script>
		$(function () {
		})
	</script>
</body>
</html>