<?php
	require_once "lib/config.php";

	$product = null;
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$_GET["id"] = intval($_GET["id"]);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, API_URL . "products/get.php?id=$_GET[id]");
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

		$product = json_decode($result);
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
				<a href="edit_product.php?id=<?php echo $product->id; ?>" class="btn btn-primary float-right">Edit product</a>
			
				<img src="<?php echo $product->image ? $product->image : "images/no_image.png"; ?>" style="display: inline-block; width: 100px; vertical-align: middle;">
				<h1 style="display: inline-block; vertical-align: middle;">
					<?php echo $product->name; ?><br>
					<small>R$ <?php echo number_format($product->price, 2, ".", ","); ?></small>
				</h1>
				
				<h2 class="mt-3">Description</h2>
				<p><?php echo $product->description; ?></p>
				
				<h2 class="mt-3">More info</h2>
				<p>Insert your email bellow to receive more details about this product!</p>
				
				<form id="form_email" action="ajax/products.php" data-ajax="true" data-success="email_sent" data-error="email_error">
					<input type="hidden" name="action" value="send_email">
					<input type="hidden" name="id" value="<?php echo $product->id; ?>">
					
					<div class="input-group mb-3" style="width:300px;">
						<input type="email" name="email" class="form-control">
						<div class="input-group-append">
							<button class="input-group-text" id="basic-addon2">Send</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<?php require_once "templates/footer.php"; ?>
	<?php require_once "templates/scripts.php"; ?>
	<script>
		function email_sent (response) {
			document.getElementById("form_email").reset();
			pretty_alert("Email sent!", "Success");
		}
		
		function email_error (response) {
			if (response.status == "notice")
				pretty_alert("Couldn't send email.<br><br>" + response.email);
			else
				pretty_alert(response.message);
		}
	</script>
</body>
</html>