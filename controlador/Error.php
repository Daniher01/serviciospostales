<?php 

class Errores extends Controller{
    
    function __construct($msj_error)
    {
        parent::__construct();
        $this->view->mensaje = 'Error al cargar el recurso';
        $this->view->render('error/error');
        error_log("ERROR DE APLICACION: $msj_error");
    }

}

?>