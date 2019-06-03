<?php
	require_once "lib/config.php";

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
				<a href="edit_retailer.php" class="btn btn-primary float-right">New retailer</a>
				<h2 class="mb-3">Retailers</h2>
				
				<div class="clearfix"></div>
			</div>

			<div class="d-flex flex-wrap justify-content-center">
			<?php foreach ($retailers as $retailer) { ?>
				<div class="thumb">
					<a href="retailer.php?id=<?php echo $retailer->id; ?>">
						<div class="retailer-logo mb-1" <?php if ( !empty($retailer->logo) ) { ?> style="background-image: url(<?php echo $retailer->logo; ?>);" <?php }?>></div>
					</a>
					<div class="descricao">
						<a href="retailer.php?id=<?php echo $retailer->id; ?>">
							<h3 class="mt-1"><?php echo $retailer->name; ?></h3>
						</a>
					<?php if ($retailer->website) { ?>
						<small><a href="<?php echo $retailer->website; ?>" target="_blank"><?php echo $retailer->website; ?></a></small>
					<?php } ?>
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