<?php 

class User extends SessionController{

    function __construct()
    {
        parent::__construct();

    }

    function render(){
        $this->view->render('usuario/editar_usuario');
    }

    public function EditarUsuario(){
        
    }

}
?>