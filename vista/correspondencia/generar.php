<?php require_once 'vista/layouts/header.php'; ?>
<title>Generar</title>

<div class="container">
    <br>
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
            <input type="text" class="form-control" required name="destinatario" placeholder="Destinatario">
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Direccion</label>
            <div class="input-group">
            <div class="custom-file">
                <input type="text" class="form-control" id="input_direccion"  required name="direccion" placeholder="Direccion"> 
                
            </div>
            <div>
                <select class="form-control" id="departamentos" onchange="imprimirValor()">
                <option value="" selected> Seleccione Departamento</option>
                <?php 
                    foreach ($this->departamentos as $departamento){
                ?>
                <option value="<?php echo $departamento['departamento'] ?>" > <?php echo $departamento['departamento'] ?></option>
                <?php     
                    }
                ?>
                </select>
            </div>
            </div> 
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Region</label>
            <select class="form-control select2 select2-danger select2-hidden-accessible" id="region" name="region" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                <?php 
                    foreach ($this->regiones as $region){
                ?>
                <option value=" <?php echo $region['idRegiones'] ?> "> <?php echo $region['regiones'] ?></option>
                <?php     
                    }
                ?>
            </select>
        </div>
        <div class="form-grup" id="comuna" >

        </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Comuna</label>
            <select class="form-control select2 select2-danger select2-hidden-accessible" name="comuna" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                
                <?php 
                    foreach ($this->comunas as $comuna){
                ?>
                <option value=" <?php echo $comuna['idComunas'] ?> "> <?php echo $comuna['Comunascol'] ?></option>
                <?php     
                    }
                ?>

            </select>
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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checkbox" value="checkbox">
                <label class="form-check-label" for="flexCheckDefault">
                    Agregar a Clientes Frecuentes
                </label>
            </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit"  class="btn btn-primary">Generar</button>
        </div>
        </form>
    </div>
            <!-- /.card -->
</div>

<script>
    window.onload = function() {
        imprimirValor();

    }

    function imprimirValor(){
        var select = document.getElementById("departamentos");
        var seleccion = document.getElementById("input_direccion");
        seleccion.value = select.value
       
    }

    function recargarLista(){
        $.ajax({
            type:"POST",
            url:"controlador/Correspondencia.php",
            data: "comuna=" + $('#region').val(),
            success:function(r){
                $('#comuna').html(r);
            }
        });
    }
</script>