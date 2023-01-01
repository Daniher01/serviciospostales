<?php 

class Login extends SessionController{

    function __construct()
    {
        parent::__construct();
        error_log('Login::contruct -> LOGINCONTROLLER ');
        //$this->authenticate();
    }

       //redirecciona al formulario para iniciar sesion
    function render(){
        error_log('Login::render -> carga el main de login');
        $this->view->render('login/main');
    }

    function authenticate(){
        error_log('LOGIN::authenticate ');
        if($this->existPOST(['rut', 'password'])){
            $rut = $this->getPost('rut');
            $password = $this->getPost('password'); //md5($this->getPost('password'));

            $user = $this->model->InicioSesionUsuario($rut, $password);
            
            if ($user!=NULL){
                
                $this->inicialize($user);
            }else{
                echo '<script> swal ( "Oops" ,  "No se pudo iniciar sesion!" ,  "error" );</script>';                
            }
        }else{
            echo '<script> swal ( "Oops" ,  "No se pudo iniciar sesion!" ,  "error" );</script>';
        }
    }  

    function closeSession(){
        $this->logout();
    }


}

?>