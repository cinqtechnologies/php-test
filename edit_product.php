<?php
	require_once "lib/config.php";

	$data = ["name" => "Ret", "logo" => "logo"];

	$product = null;
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$_GET["id"] = intval($_GET["id"]);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, API_URL . "products/get.php?id=$_GET[id]");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
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

		$product = json_decode($result);
		curl_close ($curl);
	}
	
	
	$retailers = null;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, API_URL . "retailers/read.php");
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

	$retailers = json_decode($result);
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
				<h2 class="mb-3">
				<?php if (is_null($product))
					echo "New product";
				else
					echo "Edit product";
				?>
				</h2>
			</div>

		<?php if (is_null($product)) { ?>
			<form id="form_product" method="POST" action="ajax/products.php" data-ajax="true" data-success="product_saved">
				<input type="hidden" name="action" value="create">
		<?php } else { ?>
			<form id="form_product" method="PUT" action="ajax/products.php" data-ajax="true" data-success="product_saved">
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="id" value="<?php echo $product->id ?>">
		<?php } ?>
				<div class="row">
					<div class="form-group col-12 col-md-8">
						<label>Name</label>
						<input type="text" name="name" class="form-control" required value="<?php if ($product) echo $product->name ?>">
					</div>

					<div class="form-group col-12 col-md-4">
						<label>Price</label>
						<input type="number" name="price" step=".01" class="form-control" value="<?php if ($product) echo number_format($product->price, 2, ".", ""); ?>">
					</div>

					<div class="form-group col-12">
						<label>Description</label>
						<textarea name="description" class="form-control"><?php if ($product) echo $product->description ?></textarea>
					</div>

					<div class="form-group col-12">
						<label>Image</label><br>
						<?php if ($product && $product->image) { ?>
							<div class="product-image mb-1" style="width: 170px; background-image: url(<?php echo $product->image ?>);"></div>
						<?php } ?>
						<input type="file" name="image" accept=".pdf,.png,.jpg">
					</div>
					
					<div class="form-group col-12 col-md-4">
						<label>Retailer</label>
						<select name="id_retailer" class="form-control" required>
							<option value=""></option>
						<?php foreach ($retailers as $retailer) { ?>
							<option value="<?php echo $retailer->id; ?>" <?php if ($product && $retailer->id == $product->id_retailer) echo "selected"; ?>><?php echo $retailer->name; ?></option>
						<?php } ?>
						</select>
					</div>
					
					<div class="col-12"></div>

					<div class="form-group col-12 col-md-8 mt-3">
						<button class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</section>

	<?php require_once "templates/footer.php"; ?>
	<?php require_once "templates/scripts.php"; ?>
	<script>
		function product_saved () {
			pretty_alert("Data successfully saved.", "Success");
			$("#modal-alerta").on("hidden.bs.modal", function (response) {
				location.href = "products.php";
			})
		}
	</script>
</body>
</html>