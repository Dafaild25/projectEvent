<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events and Party</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/toastify.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome.min.css'); ?>">

    <script src="<?php echo base_url('assets/js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/datatables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/all.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/toastify.js'); ?>"></script>


</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">Events and Party</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo site_url(); ?>">Start</a>
                    </li>
                    <li class="nav-item">
                        
                        <a class="nav-link" href="<?php echo site_url(); ?>/Partys/partyPage">Events</a>

                    </li>
					<li class="nav-item">
                        
                        <a class="nav-link" href="<?php echo site_url(); ?>/Asistents/asistentPage">Asistent</a>

                    </li>
                   
                </ul>
                
            </div>
        </div>
    </nav>

 
