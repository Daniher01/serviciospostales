<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titulo agregado en cada pagina -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/adaptado.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo constant('URL'); ?>assets/img/logo2.jpg" alt="Logo de recarga" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo constant('URL'); ?>" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item dropdown">
        <span class="navbar">N° Seguimiento:</span>
        </li>
            
        <li class="nav-item">
          <form class="form-inline" action="<?php echo constant('URL'); ?>Correspondencia/buscarid" method="POST">
            <div class="input-group ">
              <input class="form-control form-control-navbar" type="search" required="" placeholder="Buscar" name="n_correspondencia">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
          </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-sp elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="<?php echo constant('URL'); ?>assets/img/images.jpg" alt="Logo main" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Servicios Postales</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo constant('URL'); ?>assets/img/logo usuario2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo constant('URL'); ?>" class="d-block"><?php echo $_SESSION['username'];?></a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-header">Correspondencia</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Generar
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Con Nuevo Cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia/generarNuevoCliente" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Con Clientes Frecuentes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia/addExcel" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Masivamente</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Buscar
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia/fecha" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Por Fecha</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia/buscarDestinatario" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Por Destinatario</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia/buscarUsuarioGenerado" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Por Quien fue generado</p>
                </a>
              </li>
            </ul>
          </li>
        <?php if($_SESSION['rol']==1){ ?>
            <li class="nav-header">Administrador</li>
          <li class="nav-item">
            <a href="<?php echo constant('URL');?>Correspondencia/generarInforme" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Generar Informe
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo constant('URL');?>Departamento" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Agregar Departamento
              </p>
            </a>
          </li>
          <?php } ?> 

       <!--   <li class="nav-header">Usuario</li>
          <li class="nav-item">
            <a href="<?php //echo constant('URL');?>User" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Editar Usuario
              </p>
            </a>
          </li> -->
         
          <li class="nav-header">Sesion</li>
          <li class="nav-item">
            <a href="<?php echo constant('URL'); ?>Login/closeSession" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Cerrar Sesion
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper" style="min-height: 410px;">
    <!-- Content Header (Page header) -->
  