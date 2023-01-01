<?php require_once 'vista/layouts/header.php'; ?>
<title>Editar Usuario</title>

<div class="container">
    <br>
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Editar Usuario</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="<?php echo constant('URL'); ?>User/EditarUsuario" method="POST" >
        <div class="card-body">
            <div class="form-group">
            <label for="exampleInputPassword1">Rut</label>
            <div class="input-group">
            <div class="custom-file">
                <input type="text" class="form-control"  disabled value="<?php echo $this->rut?>"> 
            </div>
            </div> 
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Nombre</label>
            <input type="text" class="form-control"  disabled value="<?php echo $this->nombre?>"> 
            </div>

            <div class="form-group" >
            <label for="exampleInputPassword1">Email</label>
            <input type="text" class="form-control"  disabled value="<?php echo $this->email?>"> 
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Unidad de Trabajo</label>
            <input type="text" class="form-control"  name="unidad_trabajo" value="<?php echo $this->unidad_trabajo?>"> 
            </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit"  class="btn btn-primary">Editar</button>
        </div>
        </form>
    </div>
            <!-- /.card -->
</div>
<?php require_once 'vista/layouts/footer.php'; ?>
<script>
    window.onload = function() {
        imprimirValor();

    }

    function imprimirValor(){
        var select = document.getElementById("departamentos");
        var seleccion = document.getElementById("input_direccion");
        seleccion.value = select.value
       
    }


</script>