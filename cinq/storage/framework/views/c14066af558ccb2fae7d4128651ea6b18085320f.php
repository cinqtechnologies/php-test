<?php $__env->startSection('title', 'CINQ - Product'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <hr />
    <div class="row">
       <h1>Product - <?php echo e($product->name); ?></h1>
    </div>
    <hr />
        <div class="row">
                <div class="col-sm-6 col-md-6 col-xs-12 image-container">
                    <img src="<?php echo e(config('filesystems.disks.public.products')); ?>/<?php echo e($product->file_pic); ?>" class="card-img-top" alt="">
                </div>
                <div class="col-sm-6 col-md-6 col-xs-12">
                    <p><?php echo e($product->name); ?></p>
                    <p><?php echo e($product->description); ?></p>
                    <p>R$ <?php echo e($product->price); ?></p>
                    <p><a href="<?php echo e(route("retailer.show", ["id" => $product->retailer_id] )); ?>"><?php echo e($product->retailers->name); ?></a></p>
                    <p>E-mail: <input type="text" class="form-control"/></p>
                    <p><a href="/" role="button" class="btn btn-primary btn-lg">
                        Let me know when this product is available
                        </a>:
                    </p>
                </div>
        </div>
    <hr />
        <div class="row">
            <a href="/" role="button" class="btn btn-primary btn-lg">
                Voltar
            </a>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\dev\cinq\resources\views/product.blade.php ENDPATH**/ ?>