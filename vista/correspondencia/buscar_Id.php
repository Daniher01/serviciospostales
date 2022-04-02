<title>Buscar</title>

<div class="container">
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
                <p>Paquete: <?php echo ' '. $this->codigo_barras ?> </p>
              <table class="table table-bordered">

                  <tr>
                    <th>Destinatario: </th>
                    <td><?php echo $this->destinatario?></td>
                    <th>Direccion:</th>
                    <td><?php echo $this->direccion ?></td>
                  </tr>
                  <tr>
                    <th>Comuna:</th>
                    <td><?php echo $this->comunascol ?></td>
                    <th>Region:</th>
                    <td><?php echo $this->regiones ?></td>
                  </tr>  
                  <tr>
                    <th>Detalle:</th>
                    <td><?php echo $this->detalle ?></td>
                    <th>Tipo de Envio:</th>
                    <td><?php echo $this->tipo_envio ?></td>
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


      