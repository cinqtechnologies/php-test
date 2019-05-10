<?php $__env->startSection('title', 'CINQ - Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div id="row">
        <h1>Products</h1>
    </div>
    <hr />
    <div id="row">
            <table id="tableTarget">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pic</th>
                        <th>Product</th>
                        <th>Retailer</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
            </table>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascriptpage'); ?>

<script type="text/javascript">

    $(document).ready(function() {

        $('#tableTarget').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('products')); ?>",
            responsive:true,
            columns: [

                { name: 'id', selectable: true },
                { name: 'file_pic', render: function ( data, type, row, meta ) { return '<img src="'+data+'" class="img-thumbnail">'; } },
                { name: 'name', orderable: true, render: function ( data, type, row, meta ) { return '<a href="'+row.DT_RowData.producturl+'" target=_"self">'+data+'</a>'; } },
                { name: 'retailers.name',  orderable: false, render: function ( data, type, row, meta ) { return '<a href="'+row.DT_RowData.retailerurl+'" target=_"self">'+data+'</a>'; } },
                { name: 'description' },
                { name: 'price'
                 , orderable: true
                 , render: $.fn.dataTable.render.number('.',',',2,'R$')
                },
            ]
        });

    });

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\dev\cinq\resources\views/index.blade.php ENDPATH**/ ?>