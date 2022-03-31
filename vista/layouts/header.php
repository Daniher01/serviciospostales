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
    <img class="animation__shake" src="<?php echo constant('URL'); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-sp elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
      <img src="<?php echo constant('URL'); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Servicios Postales</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo constant('URL'); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Datos de la sesion</a>
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
                <a href="<?php echo constant('URL'); ?>Correspondencia/generar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nuevo Cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>Correspondencia/generarNuevoCliente" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes Frecuentes</p>
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
                <a href="<?php echo constant('URL'); ?>correspondencia/buscar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>N° Seguimiento</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo constant('URL'); ?>correspondencia/fecha" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fecha</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Seguimiento</li>
          <li class="nav-item">
            <a href="<?php echo constant('URL');?>correspondencia/generar" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Buscar
              </p>
            </a>
          </li>

          <li class="nav-header">Usuario</li>
          <li class="nav-item">
            <a href="<?php echo constant('URL');?>correspondencia/generar" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Datos del usuario
              </p>
            </a>
          </li>
         
          <li class="nav-header">Sesion</li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
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
  