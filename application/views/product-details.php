<?php if($this->session->flashdata('errors')): ?>
  <div class="alert alert-danger">
      <?php echo $this->session->flashdata('errors'); ?>
  </div>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
  <div class="alert alert-success">
    <?php echo $this->session->flashdata('success'); ?>
  </div>
<?php endif; ?>

<div class="card flex-row flex-wrap">
  <?php if(is_object($product)): ?>
    <div class="card-header border-0">
      <img src="<?=$product->image?>" alt="<?=$product->product_name?>">
    </div>

    <form method="post" action="<?php echo base_url(). 'app/send-email/' . $product->id;?>">
      <div class="card-block px-2">
        <h4 class="card-title"><?=$product->product_name?></h4>
        <h6 class="card-title">$<?=$product->price;?></h6>
        <p class="card-text"><?=$product->description?></p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_email" placeholder="E-mail" value="<?php echo $this->session->flashdata('last_post')['user_email'] ?>">
          <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>

    <div class="w-100"></div>
    <div class="card-footer w-100 text-muted">Retailer: <?=$product->retailer_name?></div>
  <?php else: ?>
    <div class="card-block px-2">
      <h4 class="card-title">Product not found</h4>
    </div>
  <?php endif; ?>
</div>