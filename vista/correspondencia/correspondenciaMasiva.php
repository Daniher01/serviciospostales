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
            <form action="<?php echo constant('URL');?>PDFController/generarMasiva" method="POST" target="_blank" >
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
                                          
                        <?php foreach($this->nombre as $key => $value){  ?>
                          <tr>   
                          <input type="hidden" name="nombre[]" value="<?php echo $value?>">
                          <input type="hidden" name="direccion[]" value="<?php echo $this->direccion[$key]?>">
                          <input type="hidden" name="region[]" value="<?php echo $this->region[$key]?>">
                          <input type="hidden" name="comuna[]" value="<?php echo $this->comuna[$key]?>">
                          <input type="hidden" name="detalle[]" value="<?php echo $this->detalle[$key]?>">
                          <input type="hidden" name="tipo_encomienda[]" value="<?php echo $this->tipo_encomienda[$key]?>">
                          <td> <?php echo $value; ?> </td>
                          <td> <?php echo $this->direccion[$key]; ?> </td>
                          <td> <?php echo $this->region[$key]; ?> </td>
                          <td> <?php echo $this->comuna[$key]; ?> </td>
                          <td> <?php echo $this->detalle[$key]; ?> </td>
                          <td> <?php echo $this->tipo_encomienda[$key]; ?> </td>
                          </tr>
                         <?php  } ?>
                        
                      <?php  }?>
                    
                            
                    </tbody> 
                </table>
              </div>
                <!-- /.card-body -->
            </div>
            </form>
    </div>

</div>
<?php require_once 'vista/layouts/footer.php'; ?>