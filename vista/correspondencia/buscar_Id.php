<?php require_once 'vista/layouts/header.php'; ?>
<title>Buscar</title>

<div class="container">
  <!-- /.navbar -->
  <br>
    <div class="card card-primary">
    <div class="card card-success">
            <div class="card">
            <form action="<?php echo constant('URL');?>PDFController/RegenerarPDF" method="POST" target="_blank" >
            <div class="card">
              <div class="card-header">
                <button type="submit" class="btn btn-outline-primary">Generar PDF</button>
              </div>
                
              <!-- /.card-header -->
              <div class="card-body" id="example1_wrapper">
                <p>Paquete: <?php echo ' '. $this->codigo_barras ?> </p>
              <table class="table table-bordered">

                  <tr>
                    <th>Destinatario: </th>
                    <td><?php echo $this->destinatario?></td>
                    <input type="hidden" name="destinatario" value="<?php echo $this->destinatario?>">
                    <th>Direccion:</th>
                    <td><?php echo $this->direccion ?></td>
                    <input type="hidden" name="direccion" value="<?php echo $this->direccion?>">
                  </tr>
                  <tr>
                    <th>Comuna:</th>
                    <td><?php echo $this->comunascol ?></td>
                    <input type="hidden" name="comuna" value="<?php echo $this->comunascol?>">
                    <th>Region:</th>
                    <td><?php echo $this->regiones ?></td>
                    <input type="hidden" name="region" value="<?php echo $this->regiones?>">
                  </tr>  
                  <tr>
                    <th>Detalle:</th>
                    <td><?php echo $this->detalle ?></td>
                    <input type="hidden" name="detalle" value="<?php echo $this->detalle?>">
                    <th>Tipo de Envio:</th>
                    <td><?php echo $this->tipo_envio ?></td>
                    <input type="hidden" name="encomienda" value="<?php echo $this->tipo_envio?>">
                  </tr>
                  
                </table>
                <br>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th >Estado</th>
                      <th>Fecha</th>
                      <th >Hora</th>
                      <th >N° Seguimiento</th>
                      <th >Codigo Interno</th>
                      <th >Creado Por</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        foreach ($this->correspondencia  as $c){
                          
                        echo " <tr>    
                                <td>".$c['estado']."</td>
                                <td>".$c['fecha']."</td>
                                <td>".$c['hora']."</td>
                                <td>".$c['numero_seguimiento']."</td>
                                <input type='hidden' name='num_seguimiento' value='".$c['numero_seguimiento']."'>
                                <td>".$c['codigo_interno']."</td>
                                <input type='hidden' name='codigo_interno' value='".$c['codigo_interno']."'>
                                <td>".$c['detalle_movimiento']."</td>
                                </tr>";  
                        }
                    ?>
                  </form>
                  </tbody>
                </table>
              </div>
                <!-- /.card-body -->
            </div>
    </div>

</div>
<?php require_once 'vista/layouts/footer.php'; ?>

      