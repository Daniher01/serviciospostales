<?php 

class MovimientoModel extends Model{

    public function __construct()
    {   
        parent::__construct();
        error_log('Contruct:: -> MovimientoModel');
    }

    public function insertMovimiento($fecha, $hora, $idusuario, $codigoBarras, $estado, $detalle_movimiento){

        try{

            $query = "INSERT INTO movimiento (fecha, hora, usuario_idusuario, correspondencia_codigo_barras, estado_idestado, detalle_movimiento)
                        VALUES('$fecha', '$hora', $idusuario, $codigoBarras, $estado, '$detalle_movimiento')";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();    
            error_log('insertMovimiento');
            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }

    }


}


?>