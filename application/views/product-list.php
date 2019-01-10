<?php if(is_object($retailer_details)): ?>
<div class="card flex-row flex-wrap">
  
    <div class="card-header border-0">
      <img src="data:image/gif;base64,<?=$retailer_details->logo?>" alt="<?=$retailer_details->name?>">
    </div>

    <div class="card-block px-2">
      <h4 class="card-title"><?=$retailer_details->name?></h4>
      <h6 class="card-title"><a href="<?=$retailer_details->website?>"><?=$retailer_details->website?></a></h6>
      <p class="card-text"><?=$retailer_details->description?></p>
    </div>

    <div class="w-100"></div>
</div>
<br />
<?php else: ?>
<!--<div class="card-block px-2">
  <h4 class="card-title">Retailer not found</h4>
</div>-->
<?php endif; ?>

<div class="card-columns">
	<?php foreach($products as $product): ?>
		<div class="card">
			<img class="card-img-top" src="data:image/gif;base64,<?=$product->image?>" alt="<?= $product->product_name;?>">
			<div class="card-body">
				<h5 class="card-title"><a href="<?php echo base_url(); ?>app/product-details/<?= $product->id;?>"><?= $product->product_name;?></a></h5>
				<h6 class="card-title"><?= $product->price;?></h6>
				<p class="card-text"><?= $product->description; ?></p>
			</div>
			<div class="card-footer">
				<small class="text-muted">Retailer: <a href="<?php echo base_url(); ?>app?retailer=<?= $product->retailer_id;?>"><?=$product->retailer_name?></a></small>
			</div>
		</div>
	<?php endforeach;?>
</div>