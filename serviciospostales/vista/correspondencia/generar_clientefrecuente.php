<?php require_once 'vista/layouts/header.php'; ?>
<title>Generar</title>
<!-- Main content -->
<section class="content ">
    <br>
    <div class="container-fluid card-header">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Generar Correspondencia</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?php echo constant('URL'); ?>PDFController/GenerarPDF" method="POST" target="_blank">
                <div class="card-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Destinatario</label>
                        <input type="text" class="form-control" required name="destinatario" readonly="readonly" placeholder="Destinatario" value="<?php echo $this->var_nombre ?>">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Direccion</label>
                    <input type="text" class="form-control" required name="direccion" readonly="readonly" placeholder="Direccion" value="<?php echo  $this->var_direccion ?>">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Region</label>
                    <input type="text" class="form-control" required name="region" readonly="readonly" placeholder="Region" value="<?php echo  $this->var_region ?>">
                </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Comuna</label>
                    <input type="hidden" class="form-control" required name="comuna" placeholder="Comuna" value="<?php echo $this->var_comunaid ?>">
                    <input type="text" class="form-control" required name="comunaNombre" readonly="readonly" placeholder="Comuna" value="<?php echo $this->var_comuna ?>">
                    </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1">Detalle</label>
                    <input type="text" class="form-control" required name="detalle" placeholder="Detalle">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Tipo Encomienda</label>
                    <select class="form-control select2 select2-danger select2-hidden-accessible" name="encomienda" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                <?php 
                    foreach ($this->tiepo_encomienda as $encomienda){
                ?>
                <option value=" <?php echo $encomienda['idTipo_encomienda'] ?> "> <?php echo $encomienda['encomienda'] ?></option>
                <?php     
                    }
                ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Codigo Interno</label>
                    <input type="text" class="form-control" required name="codigo_interno" placeholder="Codigo Interno">
                    </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit"  class="btn btn-primary">Generar</button>
                </div>
                </form>
            </div>
        </div>
    </div> 
             <!-- TABLA DE CLIENTES FRECUENTES -->
        <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-success">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Clientes Frecuentes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="example1_wrapper">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >Nombre</th>
                      <th>Direccion</th>
                      <th>Region</th>
                      <th >Comuna</th>
                      <th >Agregar</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                      <?php 
                      foreach ($this->clientes as $d){
                      echo "<tr>
                              <td>".$d['nombre']."</td>
                              <td>".$d['direccion']."</td>
                              <td>".$d['comunascol']."</td>
                              <td>".$d['regiones']."</td>";
                      echo    " <form action='". constant('URL')."Correspondencia/generarNuevoCliente' method='POST'>
                              <td>
                              <input type='hidden' name='idcliente' value=".$d['idcliente_frecuentes'].">
                              <button type='submit' class='btn btn-outline-primary'>Agregar</button>
                              </td>
                            </tr>
                            </form>";
                        }
                      ?>
    
                  </tbody>
                </table>
              </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->              
        </div>
    </div>     
</section>
<?php require_once 'vista/layouts/footer.php'; ?>