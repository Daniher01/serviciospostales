<?php 


class CorrespondenciaModel extends Model{

    public function __construct()
    {   
        parent::__construct();

    }

    public function guardarCorrespondencia($destinatario, $direccion,$codigo_barras,$detalle,$codigo_interno,$num_seguimiento, $usuario_idusuario ,$tipoenvio,$comuna){
        try{
            
            //genera el pdf
            $query = "INSERT INTO correspondencia (destinatario, direccion, codigo_barras, detalle, codigo_interno, numero_seguimiento, usuario_idusuario, tipo_encomienda_idTipo_encomienda, Comunas_idComunas)
                    VALUES ('$destinatario', '$direccion',$codigo_barras,'$detalle','$codigo_interno','$num_seguimiento', $usuario_idusuario ,$tipoenvio,$comuna)";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }


    public function getCorrespondencia(){
        try{

            $query = "SELECT * FROM Correspondencia";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function buscarNumOrden($num_seguimiento){
        try{

            $query = "SELECT  estado, destinatario, direccion, codigo_barras, codigo_interno, comunascol, regiones, detalle, encomienda, fecha, hora, numero_seguimiento FROM movimiento as m
                        INNER JOIN correspondencia as cor on m.correspondencia_codigo_barras = cor.codigo_barras
                        INNER JOIN comunas as c on c.idcomunas = cor.comunas_idcomunas
                        INNER JOIN regiones as r on r.idregiones = c.regiones_idregiones
                        INNER JOIN estado as e on e.idestado = m.estado_idestado
                        INNER JOIN tipo_encomienda as te on te.idtipo_encomienda = cor.tipo_encomienda_idtipo_encomienda
                        WHERE numero_seguimiento = '$num_seguimiento'";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);

            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function buscarFecha($f_desde, $f_hasta){
        try{

            $query = "SELECT  estado, destinatario, direccion, codigo_barras, codigo_interno, comunascol, regiones, detalle, encomienda, fecha, hora, numero_seguimiento FROM movimiento as m
            INNER JOIN correspondencia as cor on m.correspondencia_codigo_barras = cor.codigo_barras
            INNER JOIN comunas as c on c.idcomunas = cor.comunas_idcomunas
            INNER JOIN regiones as r on r.idregiones = c.regiones_idregiones
            INNER JOIN estado as e on e.idestado = m.estado_idestado
            INNER JOIN tipo_encomienda as te on te.idtipo_encomienda = cor.tipo_encomienda_idtipo_encomienda
            WHERE fecha  BETWEEN '$f_desde' AND '$f_hasta '";
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