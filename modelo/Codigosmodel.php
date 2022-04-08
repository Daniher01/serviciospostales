<?php 

class CodigosModel extends Model{
    public function __construct()
    {   
        parent::__construct();
        $this->codigo = '';
        $this->codigo_valido = '';
    }

    public function setCodigo($codigo){                             $this->codigo = $codigo;}
    public function setCodigoValido($codigo_valido){                $this->codigo_valido = $codigo_valido;}

    public function getCodigo(){                     return $this->codigo;}
    public function getCodigoValido(){               return $this->codigo_valido;}


    public function buscarCodigo($_codigo){
        try{
            $query = "SELECT * FROM codigos WHERE codigo = '$_codigo'";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rs as $r){
                $this->setCodigo($r['codigo']);
                $this->setCodigoValido($r['codigo_activo']);
            }
            error_log('MODEL:: => buscarCodigo');
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function inhabilitarCodigo($_codigo){
        try{
            $query = "UPDATE codigos SET codigo_activo = 'INHABILITADO' WHERE codigo = '$_codigo'";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();
            error_log('MODEL:: => inhabilitarCodigo');
            return $rs;
        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }
}    


?>