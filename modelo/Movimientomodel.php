<?php 

class MovimientoModel extends Model{

    public function __construct()
    {   
        parent::__construct();

    }

    public function insertMovimiento($fecha, $hora, $idusuario, $codigoBarras, $estado){

        try{

            $query = "INSERT INTO movimiento (fecha, hora, usuario_idusuario, correspondencia_codigo_barras, estado_idestado)
                        VALUES('$fecha', '$hora', $idusuario, $codigoBarras, $estado)";
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