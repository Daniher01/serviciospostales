<?php 

class Tipo_encomiendaModel extends Model{

    public function __construct()
    {   
        parent::__construct();
        $this->id = '';
        $this->encomienda = '';
    }

    public function setId($id){                             $this->id = $id;}
    public function setEncomienda($encomienda){             $this->encomienda = $encomienda;}


    public function getId(){                                return $this->id;}
    public function getEncomienda(){                        return $this->encomienda;}

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

                $this->setId($r['idTipo_encomienda']);
                $this->setEncomienda($r['encomienda']);

            }
            return $id;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e");  
        }
    }

    public function totalEncomienda($_encomienda, $f_inicio, $f_termino){
        try{
            $query = "SELECT COUNT(*) as total FROM correspondencia as cor
            INNER JOIN tipo_encomienda as te on cor.Tipo_encomienda_idTipo_encomienda = te.idTipo_encomienda
            INNER JOIN movimiento as mov on mov.Correspondencia_codigo_barras = cor.codigo_barras
            WHERE encomienda = '$_encomienda' AND fecha BETWEEN '$f_inicio' AND '$f_termino'";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }


}

?>