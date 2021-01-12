<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Yo Contribuyo - Karen">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Karen Rodriguez">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media(); ?>images/uploads/programacion-web.svg">

    <title><?php echo $data["tag_name"] ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/styles.css">
    <style>
        .avatar {
            width: 50px;
            background: #ccc;
            padding: 6px;
        }

        .avatar-big {
            width: 100px;
            background: #ccc;
            padding: 8px;
        }

        .c-checked {
            color: red;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?= media(); ?>images/uploads/programacion-web.svg" alt="Logo" style="width: 50px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>home/proyectos">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>home/articulos">Articulos</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (array_key_exists('login', $_SESSION)) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>register">Registro</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>