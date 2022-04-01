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
    <div class="card card-success">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Correspondencia </h3>
                <h3 class="card-title"> : <?php echo ' '. $this->fecha ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="example1_wrapper">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >Estado</th>
                      <th>Destinatario</th>
                      <th >Direccion</th>
                      <th >Comuna</th>
                      <th >Region</th>
                      <th >Codigo de Barra</th>
                      <th >Codigo Interno</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        foreach ($this->correspondencia  as $c){
                        echo " <tr>    
                                <td>".$c['estado']."</td>
                                <td>".$c['destinatario']."</td>
                                <td>".$c['direccion']."</td>
                                <td>".$c['comunascol']."</td>
                                <td>".$c['regiones']."</td>
                                <td>".$c['codigo_barras']."</td>
                                <td>".$c['codigo_interno']."</td>
                                </tr>";  
                        }

                      
                    ?>
    
                  </tbody>
                </table>
              </div>
                <!-- /.card-body -->
            </div>
    </div>

</div>


      