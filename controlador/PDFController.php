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
                error_log('id de la region '.$region);
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
                $emailUsuario = $_SESSION['email'];
                $asunto = 'Correspondencia Generada';
                $estimado = $_SESSION['nombre_usuario'].' '.$_SESSION['apellido_p'].' '.$_SESSION['apellido_m'];
                $html = 
                '<tr>
                    <th>N° Seguimiento</th> <td>'.$nseguimiento.'</td>
                </tr>
                <tr>
                    <th>Fecha</th> <td>'.$dia.'</td>
                </tr>
                <tr>
                    <th>Destinatario</th> <td>'.$destinatario.'</td>
                </tr>
                <tr>
                    <th>Direccion</th> <td>'.$direccion.'</td>
                </tr>
                <tr>
                    <th>Tipo Envio</th> <td>'.$tipoenvio.'</td>
                </tr>
                <tr>
                    <th>Detalle</th> <td>'.$detalle.'</td>
                </tr>
                <tr>
                    <th>Estado</th> <td>CREADO</td>
                </tr>';
                
                include_once "EMAIL/enviarEMAIL.php";
                $this->email = new EMAIL();
                $this->email->sendEmail($emailUsuario,null, $asunto,$estimado, $html);
                
                //se elimina el archivo guardado de forma temporal
                unlink($ruta);

            }else{ //si llaman a la function sin pasar los datos
                require_once 'vista/layouts/header.php';
                $controller = new Errores('Erro al llamar al generador de pdf');
                require_once 'vista/layouts/footer.php';
            }


        }

        //NO CAMBIAR NOMBRE
        function RegenerarPDF(){
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
                
                /*$comunaNombre =  $this->comunas->getIdComunaNombre($comuna);
                //id de la region
                $this->loadModel('Region'); //TODO
                $regiones = new RegionModel();
                $regionNombre = $regiones->getIdRegionNombre($region);


                $tipoenvio = $this->tipo_envio->getIdEncomiendaNombre($idtipoenvio);*/
                
                //llama a la clase que genera el pdf
                //$pdf = new PDF();
                // Data loading
                ob_start();
                $this->pdf->SetFont('Arial','',9);
                $this->pdf->AddPage();
                $this->resulset =  $this->pdf->TablaBasica($destinatario, $direccion,$region,$comuna,$detalle,$cliente,$rutuser,$idtipoenvio,$cinterno);
                $this->pdf->Output(); 
                //ob_end_flush(); 

                $code = $this->resulset[0];
                $nseguimiento = $this->resulset[1];
                $hora = $this->resulset[2];
                $dia = $this->resulset[3]; 
                

                //$this->correspondencia->guardarCorrespondencia($destinatario, $direccion, $code, $detalle,$cinterno, $nseguimiento, $usuario, $idtipoenvio, $comuna, 0);
                

                //$this->movimiento->insertMovimiento($hora, $dia, $usuario, $code, $estado, $detalle_movimiento);

                //asignar a clientes frecuentes
                /*if ($checkbox != NULL){
                    $this->loadModel('ClientesFrecuentes');
                    $movimiento = new ClientesFrecuentesModel();
                    $movimiento->insertClientesFrecuentes($destinatario, $direccion, $comuna, $usuario);
                }*/
                $emailUsuario = $_SESSION['email'];
                $asunto = 'Correspondencia Generada';
                $estimado = $_SESSION['nombre_usuario'].' '.$_SESSION['apellido_p'].' '.$_SESSION['apellido_m'];
                $html = 
                '<tr>
                    <th>N° Seguimiento</th> <td>'.$nseguimiento.'</td>
                </tr>
                <tr>
                    <th>Fecha</th> <td>'.$dia.'</td>
                </tr>
                <tr>
                    <th>Destinatario</th> <td>'.$destinatario.'</td>
                </tr>
                <tr>
                    <th>Direccion</th> <td>'.$direccion.'</td>
                </tr>
                <tr>
                    <th>Tipo Envio</th> <td>'.$idtipoenvio.'</td>
                </tr>
                <tr>
                    <th>Detalle</th> <td>'.$detalle.'</td>
                </tr>
                <tr>
                    <th>Estado</th> <td>CREADO</td>
                </tr>';
                
                include_once "EMAIL/enviarEMAIL.php";
                $this->email = new EMAIL();
                $this->email->sendEmail($emailUsuario,null, $asunto,$estimado, $html);
                
                //se elimina el archivo guardado de forma temporal
                unlink($ruta);

            }else{ //si llaman a la function sin pasar los datos
                require_once 'vista/layouts/header.php';
                $controller = new Errores('Erro al llamar al generador de pdf');
                print_r($_POST);
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

            $emailUsuario = $_SESSION['email'];
            $asunto = 'Correspondencia Generada';
            $estimado = $_SESSION['nombre_usuario'].' '.$_SESSION['apellido_p'].' '.$_SESSION['apellido_m'];
            $html = 
            '<tr>
                <th>Codigo Grupal</th> <td>'.$codigo_grupal.'</td>
            </tr>
            <tr>
                <th>Fecha</th> <td>'.$dia.'</td>
            </tr>
            <tr>
                <th>Estado</th> <td>CREADO</td>
            </tr>';
            
            include_once "EMAIL/enviarEMAIL.php";
            $this->email = new EMAIL();
            $this->email->sendEmail($emailUsuario,null, $asunto,$estimado, $html);



        }

        function generarInformePDF(){
            $f_desde = $_POST['f_desde'];
            $f_hasta = $_POST['f_hasta'];
            $Ncarta = $_POST['Ncarta'];
            $Nvalija = $_POST['Nvalija'];
            $Ncaja = $_POST['Ncaja'];
            $total = $_POST['total'];

            $cod_barras = $_POST['codigo_barras'];
            $destinatario = $_POST['destinatario'];
            $direccion = $_POST['direccion'];
            $comunas = $_POST['comunasCol'];
            $regiones = $_POST['regiones'];
            $departamento = $_POST['departamento'];
            $nombre_creador = $_POST['nombre_creador'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $estado = $_POST['estado'];

            //print_r($_POST);



            ob_start();
            $this->pdf->SetFont('Arial','',9);
            $this->pdf->AddPage();
            $this->pdf->informePT1($f_desde, $f_hasta, $Ncarta, $Nvalija, $Ncaja, $total); //otra funcion para los datos no repetidos
                
            $nombrePDF = date("d-m-y").'_'.date("H.i.s").'_'.'Correspondencia_Masiva';
            $emailUsuario = $_SESSION['email'];
            $asunto = 'Informe de Correspondencias';
            $mensaje = '
                                <h3>'.$_SESSION['nombre_usuario'].' '.$_SESSION['apellido_p'].' '.$_SESSION['apellido_m'].'</h3>
                                <p>Se adjunta Informe </p>
                            ';
            $ruta = "clases/correspondenciaPDF/$nombrePDF.pdf";
            $this->pdf->Close();
            $file =  $this->pdf->Output('S', $ruta, true); 
            header('Content-type:application/pdf');
            echo $file;
            file_put_contents("clases/correspondenciaPDF/$nombrePDF.pdf", $file);
            error_log('PDF generado');
            $rutaImagen = constant('URL').'assets/img/header.jpg';
            $estimado = $_SESSION['nombre_usuario'].' '.$_SESSION['apellido_p'].' '.$_SESSION['apellido_m'];
            $html = '                                               
            <ul>
                <li>Desde: ' .$f_desde.'</li>
                <li>Hasta: ' .$f_hasta.'</li>
                <li>N° Cartas: ' .$Ncarta.'</li>
                <li>N° Balijas: ' .$Nvalija.'</li>
                <li>N° Cajas: ' .$Ncaja.'</li>
                <li>Total Enomiendas: ' .$total.'</li>
            </ul>';

            
            
            include_once "EMAIL/enviarEMAIL.php";
            $this->email = new EMAIL();
            $this->email->sendEmail($emailUsuario,null, $asunto,$estimado, $html);

            //se elimina el archivo guardado de forma temporal
            unlink($ruta);

        }


    }



?>