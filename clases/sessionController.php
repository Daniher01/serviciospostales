<?php 
require_once 'clases/session.php';

class SessionController extends Controller{

    private $userSession;
    private $username;
    private $userid;
    private $userrut;

    private $session;
    private $sites;

    private $user;

    function __construct()
    {
        error_log('contruct:: -> SESSIONCONTROLLER');
        parent::__construct();
        $this->init();
    }

    function init(){
        error_log('SESSIONCONTROLLER::init ');
        $this->session = new Session();



        $json = $this->getJSONFileConfig();

        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];

        $this->validateSession();
    }

    private function getJSONFileConfig(){ 
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);
        return $json;
    }

    public function validateSession(){
        error_log('SESSIONCONTROLLER::validateSession ');
        //si existe la sesion
        if($this->existsSession()){
            $sessiondata = $this->getUserSessionData();
            $rol = $sessiondata->getTipoUsuario();
            error_log('existe la sesion');
            //si la pagina a entrar es publica
            if($this->isPublic()){

                $this->redirectDefaultSiteByRole($rol);

            }else{
                if($this->isAuthorized($rol)){
                   
                    error_log('es privado y autorizado su rol y su estatus');
                        
                }else{
                    error_log('es privado y no esta autorizado su rol');
                    $this->logout();
                    $this->redirect('Login', []);
                }
            }
        }else{
            //no existe la session
            if($this->isPublic()){
                error_log('isPublic no existe la sesion');
                //no pasa nada, lo deja entrar 
            }else{
                error_log('esta no es publica no existe la sesion');
                //header('Lotacion: '.constant('URL'));
                $this->redirect('Login', []);
            }
        }
    }

    function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;

        $this->userid = $this->session->getCurrentUser();
        if($this->userid) return true;

        return false;
    }

    function getUserSessionData(){ 
        $id = $this->session->getCurrentUser();
        
        $this->loadModel('Usuario');
        $this->user = new UsuarioModel();
        $this->user->BuscarUsuarioId($id);
        error_log('SESSIONCONTROLLER::getUserSessionData-> '.$this->user->getUsername());
        return $this->user;
    }

    function isPublic(){
        error_log('SESSIONCONTROLLER::isPublic');
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "",$currentURL);
        for($i = 0; $i<sizeof($this->sites); $i++){
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access']== 'public'){
                return true;
            }
        }
        return false;
    }

    function getCurrentPage(){
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actualLink);
        error_log('SESSIONCONTROLLER::getCurrentPage -> '.$url[2]);
        return $url[2];
    }

    private function redirectDefaultSiteByRole($rol){
        $url = '';
        for($i = 0; $i<sizeof($this->sites); $i++){
            if($this->sites[$i]['role'] == $rol){
                $url = $this->sites[$i]['site'];
                break;
            }
        }

        header('Location:'.constant('URL').$url);
    }

    private function isAuthorized($rol){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "",$currentURL);

        for($i = 0; $i<sizeof($this->sites); $i++){
            if ($currentURL == $this->sites[$i]['site'] && ($this->sites[$i]['role']== $rol || $this->sites[$i]['role2']== $rol)){
                error_log('ROL DEL ACCESS: '.$this->sites[$i]['role']);
                return true;
            }
        }
        return false;
    }

    function inicialize($user){
        error_log('SESSIONCONTROLLER::inicialize ');
        foreach ($user as $u){
          $this->idusuario =  $u['idUsuario'];
          $this->username = $u['username'];
          $this->rut = $u['rut'];
          $this->nombre_usuario = $u['nombre_usuario'];
          $this->apellido_p = $u['apellido_p'];
          $this->apellido_m = $u['apellido_m'];
          $this->rol = $u['tipo_usuario_idtipo_usuario'];
          $this->email = $u['email'];
        }
        error_log($this->email);
        $this->session->setCurrentUser($this->idusuario, $this->username, $this->rut,$this->nombre_usuario, $this->apellido_p, $this->apellido_m, $this->rol, $this->email);
        error_log($_SESSION['email']);
        $this->autorizeAccess($this->rol);

    }

    function autorizeAccess($rol){
        error_log('SESSIONCONTROLLER::autorizeAccess ');
        switch($rol){
            case 1:
                $this->redirect($this->defaultSites['Correspondencia'], []);
            break;
            case 2:
                $this->redirect($this->defaultSites['Correspondencia'], []);
            break;
 
        }

    }

    function logout(){
        error_log('se cierra la sesion');
        $this->session->closeSession();
        $this->redirect('', []);
    }

}



?>