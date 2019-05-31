<?php $__env->startSection('title', 'CINQ - Retailers'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div id="row">
    <h1>Retailer - <?php echo e($retailer->name); ?></h1>
    </div>
    <hr />
    <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-12 image-container">
                <img src="<?php echo e(config('filesystems.disks.public.retailers')); ?>/<?php echo e($retailer->file_pic); ?>" class="card-img-top img-thumbnail" alt="">
            </div>
            <div class="col-sm-6 col-md-6 col-xs-12">
                <p class="card-text"><?php echo e($retailer->name); ?></p>
                <p class="card-text"><?php echo e($retailer->description); ?></p>
                <p class="card-text"><a href="<?php echo e($retailer->website); ?>" target="_blank">Website</a></p>
            </div>
    </div>
    <hr />
    <div id="row">
            <table id="tableTarget">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
     </div>
     <hr />
     <div class="row">
            <a href="/" role="button" class="btn btn-primary btn-lg">
                Voltar
            </a>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascriptpage'); ?>

<script type="text/javascript">

$(document).ready(function() {

    $('#tableTarget').DataTable({
        ajax: {
                url: "<?php echo e(route('retailer.products', ['id' => $retailer->id])); ?>",
                dataSrc: ""
        },
        responsive:true,
        columns: [
            { targets: 0, data: 'id' },
            { targets: 1, data: 'file_pic', render: function ( data, type, row, meta ) { return '<img src="/storage/images/products/'+data+'" class="img-thumbnail">'; } },
            { targets: 2, data: 'name' },
            { targets: 3, data: 'description' },
            { targets: 4, data: 'price', render: $.fn.dataTable.render.number('.',',',2,'R$')}
           ],
        "autoWidth": false
    });

});

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\dev\cinq\resources\views/retailer.blade.php ENDPATH**/ ?>