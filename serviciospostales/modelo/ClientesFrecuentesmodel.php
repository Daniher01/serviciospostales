<?php 

class ClientesFrecuentesModel extends Model{


    public function __construct()
    {   
        parent::__construct();
        error_log('Contruct:: -> ClientesfrecuentesModel');
    }

    public function insertClientesFrecuentes($nombre, $direccion, $comuna, $idusuario){
        try{

            $query = "INSERT INTO cliente_frecuentes (nombre, direccion, comunas_idcomunas, usuario_idusuario)
                        VALUES ('$nombre', '$direccion', $comuna, $idusuario)";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();
            error_log($query);
            return $rs;       

        }catch (PDOException $e){
            $e->getMessage();
            error_log("$e"); 
            return $rs;
        }
    }

    public function getClienesFrecuentes($iduser){
        try{

            $query = "SELECT idcliente_frecuentes, nombre, direccion, idusuario, comunasCol, regiones FROM cliente_frecuentes as cf
                        INNER JOIN usuario as u on cf.usuario_idusuario = u.idusuario
                        INNER JOIN comunas as c on cf.comunas_idcomunas = c.idcomunas
                        INNER JOIN regiones as r on c.regiones_idregiones = r.idregiones
                        WHERE Usuario_idusuario = $iduser";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e->getMessage();
            error_log("$e"); 
            
        }
    }

    public function getClienesFrecuentesId($id){
        try{

            $query = "SELECT idcliente_frecuentes, nombre, direccion, idusuario, comunasCol,Comunas_idcomunas, regiones FROM cliente_frecuentes as cf
                        INNER JOIN usuario as u on cf.usuario_idusuario = u.idusuario
                        INNER JOIN comunas as c on cf.comunas_idcomunas = c.idcomunas
                        INNER JOIN regiones as r on c.regiones_idregiones = r.idregiones
                        WHERE idcliente_frecuentes=$id";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e->getMessage();
            error_log("$e"); 
            return $rs;
        }
    }
}

?>