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

}

?>