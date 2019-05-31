<html>
    <head>
        <title>App Name - <?php echo $__env->yieldContent('title'); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app.css')); ?>">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    </head>
    <body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <aside class="col-10 col-md-2 p-0 bg-dark">
                <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start">
                    <div class="collapse navbar-collapse">
                        <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                            <li class="nav-item"><a href="/" class="nav-link pl-0"> Products  </a></li>
                            <li class="nav-item"><a href="/createproduct" class="nav-link pl-0"> Create Product  </a></li>
                            <li class="nav-item"><a href="/createretailer" class="nav-link pl-0"> Create Retailer  </a></li>
                        </ul>
                    </div>
                </nav>
            </aside>
           <main class="col">
                    <?php echo $__env->yieldContent('content'); ?>
           </main>
        </div>
    </div>
        <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <?php echo $__env->yieldContent('javascriptpage'); ?>
    </body>
</html>
<?php /**PATH D:\dev\cinq\resources\views/layouts/app.blade.php ENDPATH**/ ?>