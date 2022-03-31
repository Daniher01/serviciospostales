<title>Buscar</title>

<div class="container">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline" action="<?php echo constant('URL');?>correspondencia/buscarid" action="GET">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" required placeholder="Search" aria-label="Search" name="n_correspondencia">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
    <br>
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Generar Correspondencia</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="#" method="POST" target="_blank">
        <div class="card-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Destinatario</label>
            <input type="text" class="form-control" readonly="readonly" name="destinatario" placeholder="Destinatario" value="<?php echo $this->destinatario ?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Direccion</label>
            <input type="text" class="form-control" readonly="readonly" name="direccion" placeholder="Direccion" value="<?php echo $this->direccion?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Codigo de Barras</label>
            <input type="text" class="form-control" readonly="readonly" name="codigo_barras" placeholder="Codigo de Barras" value="<?php echo $this->codigo_barras?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Codigo Interno</label>
            <input type="text" class="form-control" readonly="readonly" name="codigo_interno" placeholder="Codigo Interno" value="<?php echo $this->codigo_interno ?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Numero de seguimiento</label>
            <input type="text" class="form-control" readonly="readonly" name="numero_seguimiento" placeholder="Numero de seguimiento" value="<?php echo $this->numero_seguimiento ?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Usuario que la genero</label>
            <input type="text" class="form-control" readonly="readonly" name="username" placeholder="Usuario" value="<?php echo $this->username ?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Encomienda</label>
            <input type="text" class="form-control" readonly="readonly" name="encomienda" placeholder="Encomienda" value="<?php echo $this->encomienda ?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Comunas</label>
            <input type="text" class="form-control" readonly="readonly" name="comunascol" placeholder="Comunas" value="<?php echo $this->comunascol ?>">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Regiones</label>
            <input type="text" class="form-control" readonly="readonly" name="regiones" placeholder="Regiones" value="<?php echo $this->regiones ?>">
            </div>

          </div>

        <!-- /.card-body -->
        </form>
    </div>

</div>


      