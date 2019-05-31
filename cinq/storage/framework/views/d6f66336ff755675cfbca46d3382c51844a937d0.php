<?php $__env->startSection('title', 'CINQ - Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div id="row">
        <h1>Produtos</h1>
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
                <tbody>
                </tbody>
            </table>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascriptpage'); ?>

<script type="text/javascript">

    $(document).ready(function() {

        $('#tableTarget').DataTable({
            serverSide: true,
            ajax: "<?php echo e(url('/products')); ?>",
            processing: true,
            responsive:true,
            columns: [

                { name: 'id', selectable: true },
                { name: 'file_pic', render: function ( data, type, row, meta ) {
                                        return '<img src="'+data+'" class="img-thumbnail">';
                                        }
                                    },
                { name: 'name', orderable: true },
                { name: 'retailer.name',  orderable: false  },
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tarcisio/desenv/cinq/resources/views/index.blade.php ENDPATH**/ ?>