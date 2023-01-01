<?php 

class Session{

    private $sessionName = 'idusuario';
    private $sessionUserame = 'username';
    private $sessionRut = 'rut';
    private $sessionNombreUsuario = 'nombre_usuario';
    private $sessionApellidoP = 'apellido_p';
    private $sessionApellidoM = 'apellido_m';
    private $sessionRol = 'rol';
    private $sessionEmail = 'email';

    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function setCurrentUser($user, $username, $sessionrut, $name, $apellido_p, $apellido_m, $rol, $email){
        $_SESSION[$this->sessionName] = $user;
        $_SESSION[$this->sessionUserame] = $username;
        $_SESSION[$this->sessionRut] = $sessionrut;
        $_SESSION[$this->sessionNombreUsuario] = $name;
        $_SESSION[$this->sessionApellidoP] = $apellido_p;
        $_SESSION[$this->sessionApellidoM] = $apellido_m;
        $_SESSION[$this->sessionRol] = $rol;
        $_SESSION[$this->sessionEmail] = $email;

    }

    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }

    public function getUsername(){
        return $_SESSION[$this->sessionUserame];
    }

    public function getRutUser(){
        return $_SESSION[$this->sessionRut];
    }
    public function getRolUser(){
        return $_SESSION[$this->sessionRol];
    }
    public function getEmailUser(){
        return $_SESSION[$this->sessionEmail];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }

    public function exists(){
        
        return isset($_SESSION[$this->sessionName]);
    }
}

?>