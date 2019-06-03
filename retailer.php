<?php
	require_once "lib/config.php";

	$retailer = null;
	$products = [];
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$_GET["id"] = intval($_GET["id"]);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, API_URL . "retailers/get.php?id=$_GET[id]");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, API_SECURE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($curl);

		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if ($temp = curl_error($curl)) {
			$result = json_decode($result);
			echo $result->message;
			curl_close($curl);
			exit();
		}
		else if ($httpCode >= 300) {
			$result = json_decode($result);
			echo $result->message;
			exit();
		}

		$retailer = json_decode($result);
		curl_close($curl);
	}	
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
			<div class="mb-3">
				<a href="edit_retailer.php?id=<?php echo $retailer->id; ?>" class="btn btn-primary float-right">Edit retailer</a>
				
				<img src="<?php echo $retailer->logo ? $retailer->logo : "images/no_image.png"; ?>" style="display: inline-block; width: 100px; vertical-align: middle;">
				<h1 style="display: inline-block; vertical-align: middle;">
					<?php echo $retailer->name; ?><br>
				<?php if ($retailer->website) { ?>
					<small><a href="<?php echo $retailer->website; ?>"><?php echo $retailer->website; ?></a></small>
				<?php } ?>
				</h1>
			</div>
			
			<h2 class="mt-3">Description</h2>
			<p><?php echo $retailer->description; ?></p>

			<div class="section-title">
				<h2 class="mb-3">Products</h2>
			</div>
			<div class="d-flex flex-wrap justify-content-center">
			<?php foreach ($retailer->products as $product) { ?>
				<div class="thumb">
					<a href="retailer.php?id=<?php echo $product->id; ?>" target="_blank">
						<div class="retailer-logo mb-1" <?php if ( !empty($product->image) ) { ?> style="background-image: url(<?php echo $product->image; ?>);" <?php }?>></div>
					</a>
					<div class="descricao">
						<a href="product.php?id=<?php echo $product->id; ?>" target="_blank">
							<h3 class="mt-1"><?php echo $product->name; ?></h3>
						</a>
						<small><a href="product.php?id=<?php echo $product->id; ?>" target="_blank"><?php echo "R$ " . number_format($product->price, 2, ".", ","); ?></a></small>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</section>

	<?php require_once "templates/footer.php"; ?>
	<?php require_once "templates/scripts.php"; ?>
</body>
</html>