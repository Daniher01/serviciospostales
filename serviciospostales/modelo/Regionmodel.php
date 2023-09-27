<?php 

class RegionModel extends Model{

    public function __construct()
    {   
        parent::__construct();

    }

    public function getRegiones(){
        try{

            $query = "SELECT * FROM regiones";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
            return $this->rs;
        }
    }

    public function getIdRegionNombre($idregion){
        try{
            $region = $idregion;
            $query = "SELECT * FROM regiones WHERE idregiones='$idregion'";
            $datos= $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $r){
                $region = $r['regiones'];
            }
            error_log($region);
            return $region;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

}

?>