<?php 

class User extends SessionController{

    function __construct()
    {
        parent::__construct();
        $this->usuario = new UsuarioModel();
        $idusuario = $_SESSION['idusuario'];
        $d=$this->usuario->BuscarUsuarioId($idusuario);
        $this->view->rut = $this->usuario->getRut();
        $this->view->nombre = $this->usuario->getNombre().' '.$this->usuario->getApellidoP().' '.$this->usuario->getApellidoM();
        $this->view->email = $this->usuario->getEmail();
        $this->view->unidad_trabajo = $this->usuario->getDepartamento();
    }

    function render(){
        //$this->verEditarUsuario();
        $this->view->render('user/editar_usuario');
    }

    public function verEditarUsuario(){
        $idusuario = $_SESSION['idusuario'];
        $d=$this->usuario->BuscarUsuarioId($idusuario);
        $this->view->rut = $this->usuario->getRut();
        $this->view->nombre = $this->usuario->getNombre().' '.$this->usuario->getApellidoP().' '.$this->usuario->getApellidoM();
        $this->view->email = $this->usuario->getEmail();
        $this->view->unidad_trabajo = $this->usuario->getUnidadTrabajo();

        $this->view->render('user/editar_usuario');
    }

    public function EditarUsuario(){
        $idusuario = $_SESSION['idusuario'];
        $unidad_trabajo = $_POST['unidad_trabajo'];
        //$this->usuario->updateUsuario($unidad_trabajo, $idusuario);

        echo "<script type=\"text/javascript\">; alert(\"Usuario Editado con Exito\");</script>";

        $this->redirect('User', []);
            
    }
            
        

}
?>