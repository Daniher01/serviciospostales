<?php require_once 'vista/layouts/header.php'; ?>
<title>Buscar</title>

<div class="container">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar">
            <form action="<?php echo constant('URL');?>Correspondencia/readExcel" action="GET">
            <div class="mb-3">
                <input class="form-control" type="file" required name="archivo"  accept=".xls,.xlsx" enctype="multipart/form-data">
                <br>
                <button type="submit" class="btn btn-outline-primary">Cargar</button>
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
            <form action="<?php echo constant('URL');?>Correspondencia/generarMasiva" method="POST">
            <div class="card">
              <div class="card-header">
                <button type="submit" class="btn btn-outline-primary">Generar Correspondencias</button>
              </div>
              <!-- /.card-header -->
              <div class='card-body' >
                <table class='table table-bordered'>
                  <thead>
                    <tr>
                      <th >Destinatario</th>
                      <th>Direccion</th>
                      <th>Region</th>
                      <th> Comuna</th>
                      <th> Detalle</th>
                      <th>Tipo de encomienda</th>

                    </tr>
                  </thead>
                  <tbody>
                            
                  <?php if(isset($_GET['archivo'])){ ?>
                    
                    <?php for ($indiceFila = 2; $indiceFila <= $this->numeroMayorDeFila; $indiceFila++) {?>
                      <tr>

                        <input type="hidden" name="nombre[]" value="<?php echo  $this->nombre ?>" >
                        <input type="hidden" name="direccion[]" value="<?php echo  $this->direccion ?>" >
                        <input type="hidden" name="region[]" value="<?php echo  $this->region ?>" >
                        <input type="hidden" name="comuna[]" value="<?php echo  $this->comuna ?>" >
                        <input type="hidden" name="detalle[]" value="<?php echo  $this->detalle ?>" >
                        <input type="hidden" name="tipo_encomienda[]" value="<?php echo  $this->tipo_encomienda ?>" >
                        <td><?php echo  $this->nombre ?></td>
                        <td><?php echo $this->direccion ?></td>
                        <td><?php echo $this->region ?></td>
                        <td><?php echo $this->comuna ?></td>
                        <td><?php echo $this->detalle ?></td>
                        <td><?php echo $this->tipo_encomienda ?></td>
                        </tr>
                      <?php  }?>
                    <?php  } ?> 
                            
                    </tbody> 
                </table>
              </div>
                <!-- /.card-body -->
            </div>
            </form>
    </div>

</div>
<?php require_once 'vista/layouts/footer.php'; ?>