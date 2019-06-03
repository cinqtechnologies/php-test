<?php
	require_once "lib/config.php";

	$data = ["name" => "Ret", "logo" => "logo"];

	$retailer = null;
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$_GET["id"] = intval($_GET["id"]);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, API_URL . "retailers/get.php?id=$_GET[id]");
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
		// curl_setopt($curl, CURLOPT_POST, true);
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

		$retailer = json_decode($result);
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
			<div class="section-title">
				<h2 class="mb-3">
				<?php if (is_null($retailer))
					echo "New retailer";
				else
					echo "Edit retailer";
				?>
				</h2>
			</div>

		<?php if (is_null($retailer)) { ?>
			<form id="form_retailer" method="POST" action="ajax/retailers.php" data-ajax="true" data-success="retailer_saved">
				<input type="hidden" name="action" value="create">
		<?php } else { ?>
			<form id="form_retailer" method="PUT" action="ajax/retailers.php" data-ajax="true" data-success="retailer_saved">
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="id" value="<?php echo $retailer->id ?>">
		<?php } ?>
				<div class="row">
					<div class="form-group col-12 col-md-8">
						<label>Name</label>
						<input type="text" name="name" class="form-control" required value="<?php if ($retailer) echo $retailer->name ?>">
					</div>

					<div class="form-group col-12 col-md-4">
						<label>Website</label>
						<input type="url" name="website" class="form-control" value="<?php if ($retailer) echo $retailer->website ?>">
					</div>

					<div class="form-group col-12">
						<label>Description</label>
						<textarea name="description" class="form-control"><?php if ($retailer) echo $retailer->description ?></textarea>
					</div>

					<div class="form-group col-12 col-md-8">
						<label>Logo</label><br>
						<?php if ($retailer && $retailer->logo) { ?>
							<div class="retailer-logo mb-1" style="width: 170px; background-image: url(<?php echo $retailer->logo ?>);"></div>
						<?php } ?>
						<input type="file" name="logo" accept="pdf,png,jpg">
					</div>

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
		function retailer_saved () {
			pretty_alert("Data successfully saved.", "Success");
			$("#modal-alerta").on("hidden.bs.modal", function (response) {
				location.href = "retailers.php";
			})
		}
	</script>
</body>
</html>