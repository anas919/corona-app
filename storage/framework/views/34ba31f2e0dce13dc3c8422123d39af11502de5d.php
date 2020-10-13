<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo e(asset('img/fav.png')); ?>">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- Sidebar -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/sidebar.css')); ?>">

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--plugins-->
    <link href="<?php echo e(asset('js/plugins/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">

    <script src="<?php echo e(asset('js/plugins/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo e(asset('js/plugins/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/dataTables.bootstrap4.min.js')); ?>"></script>
    <!--plugins-->
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <!-- Scripts -->
    
</head>
<body>
    <div id="app">
        
        <div class="container-fluid mr-0 ml-0 mb-0 mt-0 pr-0 pl-0 pb-0 pt-0 no-print">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Espace Engineering" width="50px">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    </div>
                </div>
            </nav>
        </div>
        
        <div class="app_container">
            
            <nav id="sidebar" class="no-print" style="height: auto;">
                <div class="p-4 pt-5">
                    <a href="<?php echo e(url('/')); ?>/" class="img logo rounded-circle mb-5" style="background-image: url(<?php echo e(asset('img/logo.png')); ?>);background-size:contain;">
                    </a>

                    <ul class="list-unstyled components mb-5">
                        <li class="<?php echo e((request()->is('users')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/')); ?>/users">Utilisateurs</a>
                        </li>
                    </ul>
                    
                </div>
            </nav>
            
            <div class="app_page">
                <?php if($message = Session::get('success')): ?>
                    <div style="width: fit-content;" class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong><?php echo e($message); ?></strong>
                    </div>
                <?php endif; ?>
                <?php if($message = Session::get('errors')): ?>
                    <div style="width: fit-content;" class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong><?php echo $message; ?></strong>
                    </div>
                <?php endif; ?>
                <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div id="loading" style="display: none;">
                    <div class="modal-backdrop fade show"></div>
                    <div class="fade show loading">
                        <img id="loading-img" src="<?php echo e(asset('img/loading.gif')); ?>" alt="Loading">
                    </div>
                </div>
                <div id="modal-effect" style="display: none;">
                    <div class="modal-backdrop fade show"></div>
                    <div class="fade show loading"></div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>      
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/corona/resources/views/layouts/app.blade.php ENDPATH**/ ?>