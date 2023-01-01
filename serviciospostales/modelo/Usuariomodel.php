<?php 

class UsuarioModel extends Model{
    public function __construct()
    {   
        parent::__construct();
        $this->idusuario = 0;
        $this->username = '';
        $this->password = '';
        $this->rut = '';
        $this->nombre = '';
        $this->apellido_p = '';
        $this->apellido_m = '';
        $this->email = '';
        $this->unidad_trabajo = '';
        $this->fk_tipousuario = '';

    }

    public function setId($id){                             $this->idusuario = $id;}
    public function setUsername($_username){                $this->username = $_username;}
    public function setPassword($_password){                $this->password = $_password;}
    public function setRut($_rut){                          $this->rut = $_rut;}
    public function setNombre($_nombre){                    $this->nombre = $_nombre;}
    public function setApellidoP($_apellido_p){             $this->apellido_p = $_apellido_p;}
    public function setApellidoM($_apellido_m){             $this->apellido_m = $_apellido_m;}
    public function setEmail($_email){                      $this->email = $_email;}
    public function setDepartamento($_unidad_trabajo){     $this->unidad_trabajo = $_unidad_trabajo;}
    public function setTipoUsuario($_fk_tipousuario){            $this->fk_tipousuario = $_fk_tipousuario;}

    public function getId(){                     return $this->idusuario;}
    public function getPassword(){               return $this->password;}
    public function getUsername(){               return $this->username;}
    public function getRut(){                    return $this->rut;}
    public function getNombre(){                 return $this->nombre;}
    public function getApellidoP(){              return $this->apellido_p;}
    public function getApellidoM(){              return $this->apellido_m;}
    public function getEmail(){                  return $this->email;}
    public function getDepartamento(){          return $this->unidad_trabajo;}
    public function getTipoUsuario(){            return $this->fk_tipousuario;}


    //buscar el usuario con ese id
    public function BuscarUsuarioId(int $_idusuario){
        try{
            $query = "SELECT * FROM usuario WHERE idusuario = $_idusuario";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $r){
                $this->setId($r['idUsuario']);
                $this->setUsername($r['username']);
                $this->setRut($r['rut']);
                $this->setNombre($r['nombre_usuario']);
                $this->setApellidoP($r['apellido_p']);
                $this->setApellidoM($r['apellido_m']);
                $this->setEmail($r['email']);
                $this->setDepartamento($r['tipo_departamento']);
                $this->setTipoUsuario($r['tipo_usuario_idtipo_usuario']);
            }
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    //crear usuario
    public function crearUsuario($username, $password, $rut, $nombre_usuario, $apellido_p, $apellido_m, $email, $fk_tipousuario, $departamento){
        try{
            $rs = false;
            $existeRut = $this->buscarUsuarioRut($rut);
            if(empty($existeRut)){
                $query = "INSERT INTO usuario (username, password, rut, nombre_usuario, apellido_p, apellido_m, email, tipo_usuario_idtipo_usuario, tipo_departamento)
                VALUES('$username', '$password', '$rut','$nombre_usuario', '$apellido_p', '$apellido_m', '$email',  $fk_tipousuario, $departamento)";
                $datos = $this->db->connect()->prepare($query);
                $rs = $datos->execute();
            
            }else{
                error_log('Ya existe ese rut');
            }

            error_log('USUARIOMODEL:: => crearUsuario');
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    private function buscarUsuarioRut($rut){
        try{
            $query = "SELECT * FROM usuario WHERE rut='$rut' ";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r){
                $this->setId($r['idUsuario']);
                $this->setUsername($r['username']);
                $this->setPassword($r['password']);
                $this->setRut($r['rut']);
            }
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    //traer los tipos de usuarios
    public function getTiposUsuarios(){
        try{
            $query = "SELECT * FROM tipo_usuario ";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

        //traer los tipos de usuarios
        public function getTiposUsuariosAdminFuncionario(){
            try{
                $query = "SELECT * FROM tipo_usuario WHERE usuario = 'Administrativo' OR usuario = 'Funcionario' ";
                $datos = $this->db->connect()->query($query);
                $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
                
                return $rs;
            }catch (PDOException $e){
                $e= $e->getMessage();
                error_log("$e"); 
            }
        }

    public function updateUsuario($unidad_trabajo, $idusuario){
        try{
            $query = "UPDATE usuario SET tipo_departamento='$unidad_trabajo' WHERE idusuario=$idusuario";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();
            
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }


}


?>