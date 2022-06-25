<?php require_once 'vista/layouts/header.php'; ?>
<title>Buscar</title>

<div class="container">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar">
          <form class="form-inline" action="<?php echo constant('URL');?>Correspondencia/buscarDestinatario" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="destinatario" placeholder="Nombre del Destinatario" aria-label="Nombre del Destinatario" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="example1_wrapper">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Destinatario</th>
                      <th >N° Seguimiento</th>
                      <th >Codigo Interno</th>
                      <th >Codigo Barras</th>
                      <th ></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        foreach ($this->correspondencia  as $c){
                        echo " <tr>    
                                <td>".$c['destinatario']."</td>
                                <td>".$c['numero_seguimiento']."</td>
                                <td>".$c['codigo_interno']."</td>
                                <td>".$c['codigo_barras']."</td>
                                <td>
                                  <form action='". constant('URL')."Correspondencia/buscarId' method='POST'>
                                  <input type='hidden' value='".$c['numero_seguimiento']."' name='n_correspondencia'>  
                                  <button type='submit' class='btn btn-outline-primary'>ver Detalle</button>
                                  </form>
                                </td>
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

<?php require_once 'vista/layouts/footer.php'; ?>
      