<?php require_once 'vista/layouts/header.php'; ?>
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
            
                <div class="card-body">
                <form action="<?php echo constant('URL');?>Departamento/agregar" method="POST">
                <div class="input-group mb-3">
                    <input required type="text" name="departamento" class="form-control" placeholder="Ingrese Nuevo Departamento" aria-label="Ingrese Nuevo Departamento" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Agregar</button>
                </div>
                </form>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th >Departamentos</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        foreach ($this->departamentos  as $c){
                        echo " <tr>    
                                <td>".$c['departamento']."</td>
                                </tr>";  
                        }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
                <!-- /.card-body -->
            </div>
    </div>

</div>
<?php require_once 'vista/layouts/footer.php'; ?>