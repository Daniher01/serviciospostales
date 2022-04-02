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
                      <th >Region</th>
                      <th > Comuna</th>
                      <th > Detalle</th>
                      <th>Tipo de encomienda</th>

                    </tr>
                  </thead>
                  <tbody> <?php foreach ($this->datosexcel->getRowIterator() as $row) {  ?>
                    <tr>
                        <?php   
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE); 
                        // Esto recorre todas las celdas,
                        // incluso si no se establece un valor de celda.
                        // De forma predeterminada, solo las celdas que tienen un valor
                        // se repetirá en la iteración.
                        foreach ($cellIterator as $cell) { ?>
                        <input type='tex' name='exceldata' hidden value='<?php $cell->getValue() ?> '>
                        <td> <?php echo $cell->getValue() ?> </td>
                    <?php } ?>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
              </div>
                <!-- /.card-body -->
            </div>
            </form>
    </div>

</div>
