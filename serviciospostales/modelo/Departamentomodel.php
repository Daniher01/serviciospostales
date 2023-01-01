<?php 

class DepartamentoModel extends Model{

    public function __construct()
    {   
        parent::__construct();

    }

    public function getDepartamentos(){
        try{

            $query = "SELECT * FROM departamento";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
            return $this->rs;
        }
    }

    public function agregarDepartamento($departamento){
        try{

            $query = "INSERT INTO departamento (departamento) VALUES('$departamento')";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
            return $this->rs;
        }
    }
}

?>