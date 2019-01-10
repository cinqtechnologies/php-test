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

<div class="row">

    <form method="post" action="<?php echo base_url('app/store-product');?>" enctype="multipart/form-data">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Retailer:</strong>
                <select name="product_retailer" id="product_retailer" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($retailers as $retailer):?>
                        <option value="<?=$retailer->id?>" <?= $this->session->flashdata('last_post')['product_retailer'] == $retailer->id ? 'selected' : ''; ?>><?=$retailer->name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product name:</strong>
                <input type="text" name="product_name" value="<?php echo $this->session->flashdata('last_post')['product_name'] ?>" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="number" min="1" step="any" name="product_price" value="<?php echo $this->session->flashdata('last_post')['product_price'] ?>" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="product_description" class="form-control"><?php echo $this->session->flashdata('last_post')['product_description'] ?></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>