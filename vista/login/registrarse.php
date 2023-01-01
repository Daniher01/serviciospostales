<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrarse</title>
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
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <div class="login-logo"> 
    <a><b>Registrarse </b></a>
    </div>

      <form action="<?php echo constant('URL'); ?>NuevoUsuario/registrarse" method="POST">
        <!-- Username --> 
        <div class="input-group mb-3">
            <label for="exampleInputEmail1">Nombre de Usuario</label>
        </div>    
        <div class="input-group mb-3"> 
          <input required type="text" name="username" class="form-control" placeholder="Nombre Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
          <!-- Password -->
          <div class="input-group mb-3">
            <label for="exampleInputEmail1">Password</label>
        </div>    
          <div class="input-group mb-3">
          <input  required type="password" name="password" class="form-control" placeholder="Clave">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
                  <!-- rut -->
                  <div class="input-group mb-3">
            <label for="exampleInputEmail1">Rut</label>
        </div>    
        <div class="input-group mb-3">
          <input required  type="text" name="rut" class="form-control" placeholder="Rut">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
                          <!-- nombre -->
                          <div class="input-group mb-3">
            <label for="exampleInputEmail1">Nombres</label>
        </div>    
        <div class="input-group mb-3">
          <input required  type="text" name="nombre" class="form-control" placeholder="Nombres">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
            <!-- apellido_p -->
            <div class="input-group mb-3">
            <label for="exampleInputEmail1">Apellido Paterno</label>
        </div>    
        <div class="input-group mb-3">
          <input required  type="text" name="apellido_p" class="form-control" placeholder="Apellido Paterno">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
            <!-- apellido_m -->
            <div class="input-group mb-3">
            <label for="exampleInputEmail1">Apellido Materno</label>
        </div>    
            <div class="input-group mb-3">
          <input required type="text" name="apellido_m" class="form-control" placeholder="Apellido Materno">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <!-- email -->
        <div class="input-group mb-3">
            <label for="exampleInputEmail1">Email</label>
        </div>    
        <div class="input-group mb-3">
          <input required type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
                <!-- Unidad de trabajo -->
            <div class="input-group mb-3">
            <label for="exampleInputPassword1">Unidad de Trabajo</label>
            <select class="form-control select2 select2-danger select2-hidden-accessible" name="departamento" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                <?php 
                    foreach ($this->tiposdepartamentos as $d){
                ?>
                <option value=" <?php echo $d['iddepartamento'] ?> "> <?php echo $d['departamento'] ?></option>
                <?php     
                    }
                ?>
            </select>
            </div> 
                <!-- Codigo-->
          <div class="input-group mb-3">
          <div class="input-group mb-3">
            <label for="exampleInputEmail1">Codigo de Seguridad</label>
        </div>    
          <input required required type="text" name="codigo" class="form-control" placeholder="Codigo">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>     
                <!-- tipo usuario-->
          <div class="input-group mb-3">
          <label for="exampleInputPassword1">Tipo de Usuario</label>
            <select class="form-control select2 select2-danger select2-hidden-accessible" name="tipo_usuario" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                <?php 
                    foreach ($this->tipos_usuarios as $tp){
                ?>
                <option value=" <?php echo $tp['idtipo_usuario'] ?> "> <?php echo $tp['usuario'] ?></option>
                <?php     
                    }
                ?>
            </select>
        </div>             

        <div class="row">
          <!-- /.col -->
            <br>
            <br>
            <br>
          <div class="col-15">
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="<?php echo constant('URL'); ?>Login" >Volver</a>
      </p>

      <!-- /.social-auth-links -->
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
