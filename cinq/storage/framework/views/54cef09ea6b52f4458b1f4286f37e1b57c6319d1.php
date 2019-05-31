<?php $__env->startSection('title', 'CINQ - New Retailer'); ?>

<?php $__env->startSection('content'); ?>

<hr />
<div class="container">
    <div class="row">
    <h1>New Retailer</h1>
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
                        <label for="website">Website:</label>
                        <input type="text" class="form-control" id="website" name="website">
                </div>
                <label>Retailer Logo</label>
                <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_pic" name="file_pic">
                        <label class="custom-file-label" for="file_pic">Choose file</label>
                </div>
                <hr />
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\dev\cinq\resources\views/newretailer.blade.php ENDPATH**/ ?>