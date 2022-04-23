<?php require_once 'vista/layouts/header.php'; ?>
<title>Buscar</title>

<div class="container">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar">
          <form class="form-inline" action="<?php echo constant('URL');?>Correspondencia/generarInforme" method="POST">
            <div class="input-group input-group-sm">
              <span class="navbar">Desde:</span>
              <input class="form-control form-control-navbar" type="date" required placeholder="Search" aria-label="Search" name="f_desde">
              <span class="navbar">Hasta:</span>
              <input class="form-control form-control-navbar" type="date" required placeholder="Search" aria-label="Search" name="f_hasta">
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
    <form action="<?php echo constant('URL'); ?>PDFController/generarInformePDF" method="POST" target="_blank"> 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><input class="btn btn-primary" type="submit" value="Generar"> </h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body" id="example1_wrapper">
             
                <table class="table table-bordered">
                    <tr>
                      <th>Desde: </th>
                      <input type="hidden" name="f_desde" value="<?php echo $this->f_desde?>">
                      <td><?php echo $this->f_desde?></td>
                      </tr>
                      <tr>
                      <th>Hasta:</th>
                      <input type="hidden" name="f_hasta" value="<?php echo $this->f_hasta?>">
                      <td><?php echo $this->f_hasta ?></td>
                    </tr>
                    <tr>
                      <th>N° Cartas:</th>
                      <input type="hidden" name="Ncarta" value="<?php echo $this->Ncarta?>">
                      <td><?php echo $this->Ncarta?></td>

                    </tr>  
                    <tr>
                      <th>N° Valijas:</th>
                      <input type="hidden" name="Nvalija" value="<?php echo $this->Nvalija?>">
                      <td><?php echo $this->Nvalija ?></td>

                    </tr>
                    <tr>
                      <th>N° Cajas:</th>
                      <input type="hidden" name="Ncaja" value="<?php echo $this->Ncaja?>">
                      <td><?php echo $this->Ncaja ?></td>

                    </tr>
                    <tr>
                      <th>Total Encomiendas:</th>
                      <input type="hidden" name="total" value="<?php echo $this->totalEncomiendas?>">
                      <td><?php echo $this->totalEncomiendas ?></td>

                    </tr>
                    
                  </table>
                  <br>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                      <th >Codigo Barra</th>
                        <th>Destinatario</th>
                        <th >Direccion Destino</th>
                        <th >Comuna</th>
                        <th >Region</th>
                        <th >Departamento Creador</th>
                        <th >Nombre Creador</th>
                        <th >Fecha </th>
                        <th >Hora</th>
                        <th >Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="datosInforme" value="<?php echo serialize($this->datosInforme)?>">
                      <?php 
                       
                          foreach ($this->datosInforme  as $c){
                          echo "
                          <input type='hidden' name='codigo_barras[]' value='".$c['codigo_barras']."'>
                          <input type='hidden' name='destinatario[]' value='".$c['destinatario']."'>
                          <input type='hidden' name='direccion[]' value='".$c['direccion']."'>
                          <input type='hidden' name='comunasCol[]' value='".$c['comunasCol']."'>
                          <input type='hidden' name='regiones[]' value='".$c['regiones']."'>
                          <input type='hidden' name='departamento[]' value='".$c['departamento']."'>
                          <input type='hidden' name='nombre_creador[]' value='".$c['nombre_creador']."'>
                          <input type='hidden' name='fecha[]' value='".$c['fecha']."'>
                          <input type='hidden' name='hora[]' value='".$c['hora']."'>
                          <input type='hidden' name='estado[]' value='".$c['estado']."'>
                          ";
                          echo " <tr>    
                                  <td>".$c['codigo_barras']."</td>
                                  <td>".$c['destinatario']."</td>
                                  <td>".$c['direccion']."</td>
                                  <td>".$c['comunasCol']."</td>
                                  <td>".$c['regiones']."</td>
                                  <td>".$c['departamento']."</td>
                                  <td>".$c['nombre_creador']."</td>
                                  <td>".$c['fecha']."</td>
                                  <td>".$c['hora']."</td>
                                  <td>".$c['estado']."</td>
                                  </tr>";  
                          }
                      ?>
      
                    </tbody>
                  </table>
                  </form>   
              </div>
                <!-- /.card-body -->
            </div>
    </div>


</div>

<?php require_once 'vista/layouts/footer.php'; ?>
      