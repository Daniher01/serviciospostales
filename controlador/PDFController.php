<?php 

    require('clases/pdfs.php');
    
    class PDFController extends SessionController{


        function __construct()
        {
            parent::__construct();

        }
        //NO CAMBIAR NOMBRE
        function GenerarPDF(){
            $this->resulset = [];
            $this->mensaje= 'No definido';
            if ($_POST){
                $destinatario = $_POST['destinatario'];
                $direccion = $_POST['direccion'];
                $region = $_POST['region'];
                $comuna = $_POST['comuna'];
                $detalle = $_POST['detalle'];
                $idtipoenvio = $_POST['encomienda'];
                $cliente = "Universidad Talca";
                $rutuser = $_SESSION['rut'];
                $cinterno = $_POST['codigo_interno'];
                $usuario = $_SESSION['idusuario'] ;
                $detalle_movimiento =  $_SESSION['nombre_usuario'].' '. $_SESSION['apellido_p'].' '.$_SESSION['apellido_m'];
                $estado = 1; //siemrpe el mismo estado
                $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : NULL;
                //llama al modelo para traer los datos faltantes
                //id de la comuna
                $this->loadModel('Comunas'); //TODO
                $comunas = new ComunasModel();
                $comunaNombre = $comunas->getIdComunaNombre($comuna);
                //id de la region
                $this->loadModel('Region'); //TODO
                $regiones = new RegionModel();
                $regionNombre = $regiones->getIdRegionNombre($region);

                //id de la encomienda
                $this->loadModel('Tipo_encomienda'); //TODO
                $tipo_envio = new Tipo_encomiendaModel();
                $tipoenvio = $tipo_envio->getIdEncomiendaNombre($idtipoenvio);
                
                //llama a la clase que genera el pdf
                $pdf = new PDF();
                // Data loading
                ob_start();
                $pdf->SetFont('Arial','',9);
                $pdf->AddPage();
                $this->resulset = $pdf->TablaBasica($destinatario, $direccion,$regionNombre,$comunaNombre,$detalle,$cliente,$rutuser,$tipoenvio,$cinterno);
                $pdf->Output(); 
                //ob_end_flush(); 

                $code = $this->resulset[0];
                $nseguimiento = $this->resulset[1];
                $hora = $this->resulset[2];
                $dia = $this->resulset[3]; 
                
                //modelo para ingresar la correspondencia
                $this->loadModel('Correspondencia'); 
                $correspondencia = new CorrespondenciaModel();
                $correspondencia->guardarCorrespondencia($destinatario, $direccion, $code, $detalle,$cinterno, $nseguimiento, $usuario, $idtipoenvio, $comuna);
                
                //modelo para ingresar el movimiento
                $this->loadModel('Movimiento');
                $movimiento = new MovimientoModel();
                $movimiento->insertMovimiento($hora, $dia, $usuario, $code, $estado, $detalle_movimiento);

                //asignar a clientes frecuentes
                if ($checkbox != NULL){
                    $this->loadModel('ClientesFrecuentes');
                    $movimiento = new ClientesFrecuentesModel();
                    $movimiento->insertClientesFrecuentes($destinatario, $direccion, $comuna, $usuario);
                }

            }else{ //si llaman a la function sin pasar los datos
                require_once 'vista/layouts/header.php';
                $controller = new Errores('Erro al llamar al generador de pdf');
                require_once 'vista/layouts/footer.php';
            }


        }
    }

?>