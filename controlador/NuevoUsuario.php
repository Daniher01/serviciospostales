<?php 

class NuevoUsuario extends SessionController{

    function __construct()
    {
        parent::__construct();
    
        //carga la bd de codigos
        $this->loadModel('Codigos');
        $this->codigos = new CodigosModel();

        //carga la bd de usuadios
        $this->loadModel('Usuario');
        $this->usuarios = new UsuarioModel();
        $this->view->tipos_usuarios = $this->usuarios->getTiposUsuariosAdminFuncionario();
        //carga los datos de los departamentos
        $this->loadModel('Departamento');
        $this->departamentos = new DepartamentoModel();
        $this->view->tiposdepartamentos = $this->departamentos->getDepartamentos();

    }

    function render(){
        $this->verRegistrarse();
    }

    function verRegistrarse(){
        
        $this->view->render('login/registrarse');
    }

    function registrarse(){
        //print_r($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rut = $_POST['rut'];
        $nombre = $_POST['nombre'];
        $apellido_p = $_POST['apellido_p'];
        $apellido_m = $_POST['apellido_m'];
        $email = $_POST['email'];
        $departamento = $_POST['departamento'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $codigo = $_POST['codigo'];

        //print_r($tipo_usuario);

        //trae la habilitacion del codigo
        $this->codigos->buscarCodigo($codigo);
        
        if($this->codigos->getCodigoValido() == 'HABILITADO'){
            $secreo = $this->usuarios->crearUsuario($username, $password, $rut, $nombre, $apellido_p, $apellido_m, $email, $tipo_usuario, $departamento);
            if($secreo){
                $this->codigos->inhabilitarCodigo($codigo);
                $this->redirect($this->defaultSites['Login'], []);
                error_log('usuario creado con exito');
            }else{
                echo "<script type=\"text/javascript\">; alert(\"Usuario no creado, rut ya existe\");</script>";
                //$this->redirect($this->defaultSites['Login'], []);
                error_log('usuario no creado, ya existe el rut');
            }

        }else{
            error_log('no esta habilitado');
            echo "<script type=\"text/javascript\">; alert(\"Codigo No Habilitado\");</script>"; 
        }


        $this->view->render('login/registrarse');
    }


}


?>