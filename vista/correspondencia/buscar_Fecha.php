<title>Buscar</title>

<div class="container">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar">
          <form class="form-inline" action="<?php echo constant('URL');?>correspondencia/buscarFecha" action="GET">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="date" required placeholder="Search" aria-label="Search" name="fecha">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
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
                      <th >Destinatario</th>
                      <th>Direccion</th>
                      <th >Detalle</th>
                      <th >Codigo Interno</th>
                      <th >Numero Seguimiento</th>
                      <th>Usuario Creador</th>
                      <th>Tipo de encomienda</th>
                      <th>Comuna</th>
                      <th>Region</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        foreach ($this->correspondencia  as $c){
                        echo " <tr>    
                                <td>".$c['destinatario']."</td>
                                <td>".$c['direccion']."</td>
                                <td>".$c['detalle']."</td>
                                <td>".$c['codigo_interno']."</td>
                                <td>".$c['numero_seguimiento']."</td>
                                <td>".$c['username']."</td>
                                <td>".$c['encomienda']."</td>
                                <td>".$c['comunascol']."</td>
                                <td>".$c['regiones']."</td>
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


      