<?php 

class Tipo_encomiendaModel extends Model{

    public function __construct()
    {   
        parent::__construct();
    }

    public function getTipo_encomienda(){
        try{
            
            $query = "SELECT * FROM tipo_encomienda";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function getIdEncomiendaNombre($idencomienda){
        try{
            
            $query = "SELECT * FROM tipo_encomienda WHERE idTipo_encomienda = $idencomienda";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $r){
                $id = $r['encomienda'];
            }
            return $id;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function getEncomiendaId($nombre_encomienda){
        try{
            $query = "SELECT * FROM tipo_encomienda WHERE encomienda = '$nombre_encomienda'";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $r){
                $id = $r['idTipo_encomienda'];
            }
            return $id;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }


}

?>