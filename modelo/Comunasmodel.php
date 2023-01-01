<?php 

class ComunasModel extends Model{



    public function __construct()
    {   
        parent::__construct();
        $this->id = 0;

    }

    public function getComunas(){
        try{

            $query = "SELECT * FROM comunas";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
            return $this->rs;
        }
    }

    public function getIdComunaNombre($idcomuna){
        try{
            $query = "SELECT * FROM comunas WHERE idComunas='$idcomuna'";
            $datos= $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $c){
                $comuna = $c['Comunascol'];
            }
            return $comuna;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function getComunasIdRegion($_idregion){
        try{
            $query = "SELECT * FROM comunas WHERE Regiones_idRegiones =$_idregion";
            $datos= $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function getComunaId($nombre_comuna){
        try{
            $query = "SELECT * FROM comunas WHERE ComunasCol ='$nombre_comuna'";
            $datos= $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $c){
                $idcomuna = $c['idComunas'];
            }
            return $idcomuna;
            
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

}

?>