<!DOCTYPE html>
<html lang="en">
<head>
    <title>Iniciar Sesion</title>
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
<body class=" hold-transition login-page " >
<div class="login-box">
  <div class="login-logo">
    <a><b>Servicios </b>Postales</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesion</p>

      <form action="<?php echo constant('URL'); ?>Login/authenticate" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="rut" class="form-control" placeholder="Rut">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <!-- /.col -->
            <br>
            <br>
            <br>
          <div class="col-15">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a >¿No estas Registrado?</a>
        <a href="<?php echo constant('URL'); ?>NuevoUsuario" >Registrarse</a>
      </p>

      <p class="mb-1">
        <a >¿Necesitas Ayuda?</a>
        <a href="<?php echo constant('URL'); ?>Ayuda" >Haz click aqui</a>
      </p>

      <p class="mb-1">
        <a href="<?php echo constant('INDEX'); ?>" >Ir la inicio</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo constant('URL'); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo constant('URL'); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo constant('URL'); ?>assets/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
