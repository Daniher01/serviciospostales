<?php 

class Ayuda extends Controller{
    
    function __construct()
    {
        parent::__construct();
    }

    function render(){
        error_log('Ayuda::render -> carga la pagina de ayuda');
        $this->view->render('ayuda/ayuda');
    }

}

?>