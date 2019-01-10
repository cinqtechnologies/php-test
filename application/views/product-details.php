
<div class="card flex-row flex-wrap">
  <?php if(is_object($product)): ?>
    <div class="card-header border-0">
      <img src="<?=$product->image?>" alt="<?=$product->product_name?>">
    </div>

    <div class="card-block px-2">
      <h4 class="card-title"><?=$product->product_name?></h4>
      <h6 class="card-title">$<?=$product->price;?></h6>
      <p class="card-text"><?=$product->description?></p>
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="user_email" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <a href="#" class="btn btn-primary">Submit e-mail</a>
        </div>
      </div>
    </div>

    <div class="w-100"></div>
    <div class="card-footer w-100 text-muted">Retailer: <?=$product->retailer_name?></div>
  <?php else: ?>
    <div class="card-block px-2">
      <h4 class="card-title">Product not found</h4>
    </div>
  <?php endif; ?>
</div>