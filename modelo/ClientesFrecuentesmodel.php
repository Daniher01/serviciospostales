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

    public function getClienesFrecuentes(){
        try{

            $query = "SELECT idcliente_frecuentes, nombre, direccion, idusuario, comunascol, regiones FROM Cliente_Frecuentes as cf
                        INNER JOIN Usuario as u on cf.Usuario_idusuario = u.idusuario
                        INNER JOIN Comunas as c on cf.Comunas_idComunas = c.idcomunas
                        INNER JOIN Regiones as r on c.Regiones_idRegiones = r.idregiones";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e->getMessage();
            error_log("$e"); 
            return $rs;
        }
    }

    public function getClienesFrecuentesId($id){
        try{

            $query = "SELECT idcliente_frecuentes, nombre, direccion, idusuario, comunascol,Comunas_idComunas, regiones FROM Cliente_Frecuentes as cf
                        INNER JOIN Usuario as u on cf.Usuario_idusuario = u.idusuario
                        INNER JOIN Comunas as c on cf.Comunas_idComunas = c.idcomunas
                        INNER JOIN Regiones as r on c.Regiones_idRegiones = r.idregiones
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