<?php $__env->startSection('title', 'CINQ - New Product'); ?>

<?php $__env->startSection('content'); ?>

<hr />
<div class="container">
    <div class="row">
    <h1>New Product</h1>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" role="form" action="/createproduct" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" name="price">
                </div>
                <label>Product Image</label>
                <div class="custom-file">

                        <input type="file" class="custom-file-input" id="file_pic" name="file_pic">
                        <label class="custom-file-label" for="file_pic">Choose file</label>
                </div>
                <hr />
                <div class="form-group">
                        <label for="retailer_id">Retailer Name:</label>
                        <select name="retailer_id" id="retailer_id" class="form-control">
                            <option> - Select a Retailer - </option>
                            <?php $__currentLoopData = $retailers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retailer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($retailer->id); ?>"><?php echo e($retailer->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                </div>
                <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="descrption" id="description" class="form-control">
                        </textarea>
                </div>
                <div class="form-group">
                        <input type="submit"  class="btn btn-primary btn-lg" name="register" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\dev\cinq\resources\views/newproduct.blade.php ENDPATH**/ ?>