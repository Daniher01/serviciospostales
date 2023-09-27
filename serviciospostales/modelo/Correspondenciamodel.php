<?php 


class CorrespondenciaModel extends Model{

    public function __construct()
    {   
        parent::__construct();
        error_log('Contruct::CorrespondenciaModel');
    }

    public function guardarCorrespondencia($destinatario, $direccion,$codigo_barras,$detalle,$codigo_interno,$num_seguimiento, $usuario_idusuario ,$tipoenvio,$comuna, $codigo_grupal){
        try{
            
            //genera el pdf
            $query = "INSERT INTO correspondencia (destinatario, direccion, codigo_barras, detalle, codigo_interno, numero_seguimiento, usuario_idusuario, tipo_encomienda_idTipo_encomienda, Comunas_idcomunas, codigo_masivo)
                    VALUES ('$destinatario', '$direccion',$codigo_barras,'$detalle','$codigo_interno','$num_seguimiento', $usuario_idusuario ,$tipoenvio,$comuna, $codigo_grupal)";
            $datos = $this->db->connect()->prepare($query);
            $rs = $datos->execute();
            error_log('guardaCorrespondencia');
            
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

            $query = "SELECT  estado, destinatario, direccion, codigo_barras, codigo_interno, comunasCol, regiones, detalle, encomienda, fecha, hora, numero_seguimiento, detalle_movimiento FROM movimiento as m
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

            $query = "SELECT DISTINCT numero_seguimiento, destinatario, direccion, codigo_barras, codigo_interno, comunasCol, regiones, detalle, encomienda FROM movimiento as m
            INNER JOIN correspondencia as cor on m.correspondencia_codigo_barras = cor.codigo_barras
            INNER JOIN comunas as c on c.idcomunas = cor.comunas_idcomunas
            INNER JOIN regiones as r on r.idregiones = c.regiones_idregiones
            INNER JOIN tipo_encomienda as te on te.idtipo_encomienda = cor.tipo_encomienda_idtipo_encomienda
            WHERE fecha  BETWEEN '$f_desde' AND '$f_hasta'
            ORDER BY fecha DESC";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            
            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function buscarDestinatario($destinatario){
        try{

            $query = "SELECT DISTINCT numero_seguimiento, destinatario, direccion, codigo_barras, codigo_interno, comunasCol, regiones, detalle, encomienda FROM movimiento as m
            INNER JOIN correspondencia as cor on m.correspondencia_codigo_barras = cor.codigo_barras
            INNER JOIN comunas as c on c.idcomunas = cor.comunas_idcomunas
            INNER JOIN regiones as r on r.idregiones = c.regiones_idregiones
            INNER JOIN tipo_encomienda as te on te.idtipo_encomienda = cor.tipo_encomienda_idtipo_encomienda
            WHERE destinatario  LIKE '%$destinatario%'
            ORDER BY fecha DESC";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            
            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function buscarUsuarioQueLoGenero($usuario){
        try{

            $query = "SELECT  * FROM movimiento as m
            INNER JOIN correspondencia as cor on m.correspondencia_codigo_barras = cor.codigo_barras       
            WHERE detalle_movimiento  LIKE '%$usuario%'
            ORDER BY fecha DESC";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            
            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function buscarCodigoMasivo($codigo_masivo){
        try{

            $query = "SELECT destinatario, direccion, regiones, comunasCol, detalle_movimiento, codigo_interno, numero_seguimiento, encomienda  FROM correspondencia as cor
                        INNER JOIN comunas as c on c.idcomunas = cor.Comunas_idcomunas
                        INNER JOIN regiones as r on r.idregiones = c.Regiones_idregiones
                        INNER JOIN movimiento as m on m.Correspondencia_codigo_barras = cor.codigo_barras
                        INNER JOIN tipo_encomienda as te on te.idTipo_encomienda = cor.Tipo_encomienda_idTipo_encomienda
                        WHERE codigo_masivo = $codigo_masivo";
            $datos = $this->db->connect()->query($query);
            $rs = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $rs;

        }catch (PDOException $e){
            $e= $e->getMessage();
            error_log("$e"); 
        }
    }

    public function buscarInformeCorrespondenciaFechas($f_desde, $f_hasta){
        try{

            $query = "SELECT cor.codigo_barras, cor.destinatario, cor.direccion, com.comunasCol, r.regiones, d.departamento, CONCAT(u.nombre_usuario,' ', u.apellido_p, ' ', u.apellido_m) as nombre_creador, mov.fecha, mov.hora, e.estado 
            FROM movimiento as mov
            INNER JOIN correspondencia as cor on cor.codigo_barras = mov.Correspondencia_codigo_barras
            INNER JOIN comunas as com on com.idcomunas = cor.Comunas_idcomunas
            INNER JOIN regiones as r on r.idregiones = com.Regiones_idregiones
            INNER JOIN usuario as u on u.idusuario = cor.Usuario_idusuario
            INNER JOIN departamento as d on u.tipo_departamento = d.iddepartamento
            INNER JOIN estado as e on mov.Estado_idEstado = e.idEstado
            WHERE fecha  BETWEEN '$f_desde' AND '$f_hasta'";
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