<?php 

    require('clases/pdfs.php');
    
    class PDFController extends SessionController{


        function __construct()
        {
            parent::__construct();
            $this->pdf = new PDF();

            $this->loadModel('Comunas'); //TODO
            $this->comunas = new ComunasModel();

            //id de la encomienda
            $this->loadModel('Tipo_encomienda'); //TODO
            $this->tipo_envio = new Tipo_encomiendaModel();

            //modelo para ingresar la correspondencia
            $this->loadModel('Correspondencia'); 
            $this->correspondencia = new CorrespondenciaModel();

            //modelo para ingresar el movimiento
            $this->loadModel('Movimiento');
            $this->movimiento = new MovimientoModel();

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

                $comunaNombre =  $this->comunas->getIdComunaNombre($comuna);
                //id de la region
                $this->loadModel('Region'); //TODO
                $regiones = new RegionModel();
                $regionNombre = $regiones->getIdRegionNombre($region);


                $tipoenvio = $this->tipo_envio->getIdEncomiendaNombre($idtipoenvio);
                
                //llama a la clase que genera el pdf
                //$pdf = new PDF();
                // Data loading
                ob_start();
                $this->pdf->SetFont('Arial','',9);
                $this->pdf->AddPage();
                $this->resulset =  $this->pdf->TablaBasica($destinatario, $direccion,$regionNombre,$comunaNombre,$detalle,$cliente,$rutuser,$tipoenvio,$cinterno);
                $this->pdf->Output(); 
                //ob_end_flush(); 

                $code = $this->resulset[0];
                $nseguimiento = $this->resulset[1];
                $hora = $this->resulset[2];
                $dia = $this->resulset[3]; 
                

                $this->correspondencia->guardarCorrespondencia($destinatario, $direccion, $code, $detalle,$cinterno, $nseguimiento, $usuario, $idtipoenvio, $comuna, 0);
                

                $this->movimiento->insertMovimiento($hora, $dia, $usuario, $code, $estado, $detalle_movimiento);

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

        function generarMasiva(){
            $archivo = $_POST['archivo'];
            $idusuario = $_SESSION['idusuario'];
            $rutusuario = $_SESSION['rut'];
            $nombre =$_POST['nombre'];
            $direccion = $_POST['direccion'];
            $region = $_POST['region'];
            $comuna = $_POST['comuna'];
            $detalle = $_POST['detalle'];
            $tipo_encomienda = $_POST['tipo_encomienda'];
            $codigo_interno = '123456789';
            $estado = 1; //siemrpe el mismo estado
            $cliente = "Universidad Talca";
            $detalle_movimiento =  $_SESSION['nombre_usuario'].' '. $_SESSION['apellido_p'].' '.$_SESSION['apellido_m'];
            
            $milisegundos = round(microtime(true) * 1000);
            $fcad = date("YmdHis", time());
            $facsfsegu = date("mYd", time());
            $rest = substr(''.$milisegundos.'', 0, -3);
            $milisegundos = substr(''.$milisegundos.'', 0, -8);
            
            $codigo_grupal = '07'. $facsfsegu.$rest; //tambien como codigo masivo
            $dia = date("Y-m-d H:i:s", time());
            $hora = date("Y-m-d H:i:s", time());

            //agregar a la BD
            if ($_POST){
                $contador = 1;
                //prepara par agenerar los PDF´S
                ob_start();
                $this->pdf->SetFont('Arial','',9);
                $this->pdf->AddPage();
                foreach($nombre as $key => $value){
                    $nombre_valor = $nombre[$key];
                    $direccion_valor = $direccion[$key];
                    $region_valor = $region[$key];
                    $comuna_valor = $comuna[$key];
                    $detalle_valor = $detalle[$key];
                    $tipo_encomienda_valor = $tipo_encomienda[$key];
                    $nseguimiento = $contador + $codigo_grupal;
                    $code =$milisegundos.$fcad + $contador;
                    $idcomuna = $this->comunas->getComunaId($comuna_valor); //trae el id de la comuna
                    $idTipo_encomienda = $this->tipo_envio->getEncomiendaId($tipo_encomienda_valor);
                    
                    $contador = $contador + 1 ;    
                    
                    $this->correspondencia->guardarCorrespondencia($nombre_valor, $direccion_valor, $code, $detalle_valor, $codigo_interno, $nseguimiento, $idusuario, $idTipo_encomienda, $idcomuna, $codigo_grupal);
                    $this->movimiento->insertMovimiento($hora, $dia, $idusuario, $code, $estado, $detalle_movimiento);


                    $this->pdf->TablaBasica($nombre_valor, $direccion_valor,$region_valor,$comuna_valor,$detalle_valor,$cliente,$rutusuario,$tipo_encomienda_valor,$codigo_interno);
                    
                }
                /*$this->pdf->Output(); 

                ob_start();
                $this->pdf->SetFont('Arial','',9);
                $this->pdf->AddPage();*/
                $this->pdf->generarMasiva($codigo_grupal);
                $this->pdf->Output(); 
                //ob_end_flush();
                unlink($archivo);
            }



        }
    }

?>