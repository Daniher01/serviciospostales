<?php
//style="visibility:hidden";

//$destinatario = $_POST['nombred'];
//$direccion = $_POST['direccion'];
//$region = $_POST['region'];
//$comuna = $_POST['lista2'];
//$cliente = $_POST['comuna'];
//$rutuser = $_POST['rutuser'];
//$tipoenvio = $_POST['tenvio'];
//$cinterno = $_POST['codigoi'];
/*
$destinatario = "Juan Brisenuos";
$direccion = "12 sur #97";
$region = "Maule";
$comuna = "Talca";
$detalle = "encomienda fragil";
$cliente = "Universidad Talca";
$rutuser = "16650344-2";
$tipoenvio = "Sobre";
$cinterno = "132547838"; */


require('fpdf/fpdf.php');
include 'barcode.php';

class PDF extends FPDF
{


    function TablaBasica($destinatario, $direccion,$region,$comuna,$detalle,$cliente,$rutuser,$tipoenvio,$cinterno)
    {
  
        //$rest = substr(''.$rutuser.'', 0, -8);
        $milisegundos = round(microtime(true) * 1000);
        $fcad = date("YmdHi", time());
        $facsfsegu = date("mYd", time());
        $rest = substr(''.$milisegundos.'', 0, -3);
        $code =$milisegundos.$fcad;
        $nsiguimiento = $facsfsegu.$rest;
        $dia = date("Y-m-d H:i:s", time());
        $hora = date("Y-m-d H:i:s", time());
        
        barcode('clases/codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
        $ahora = date("Y-m-d H:i:s");

        //Cabecera
        //foreach($header as $col)
        //$this->Cell(40,7,$col,1);
    
        // $this->Cell(20,70,'Destinatario :',0);
        //$this->Image('logo/logo.jpg',10,20,50,0,'JPG');
        //$this->Image('codigos/'.$code.'.png',10,40,50,0,'PNG');
        //$this->Cell(50,10, $this->Image('clases/codigos/'.$code.'.png', $this->GetX(), $this->GetY(),50,10),0);
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"Fecha y hora:",0);
        $this->Cell(20,10,''.$ahora.'',0);
        $this->Cell(20,10,"",0);  
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"",0); 
        $this->Ln();
        $this->Cell(50,5, $this->Image('clases/logo/logo.jpg', $this->GetX(), $this->GetY(),40,30),0);
        $this->Cell(20,5,"Destinatario:",0);
        $this->Cell(20,5,"".$destinatario."",0);
        $this->Cell(20,5,"",0);
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);
        $this->Ln();
        $this->Cell(50,5,"",0);
        $this->Cell(20,5,"Direccion :",0);
        $this->Cell(20,5,"".$direccion."",0);
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);
        $this->Cell(20,5,"Region:",0);
        $this->Cell(20,5,"".$region."",0);  
        $this->Ln();
        $this->Cell(50,5,"",0);
        $this->Cell(20,5,"N. Seguimiento: ".$nsiguimiento."",0);  
        $this->Cell(20,5,"",0);
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);
        $this->Cell(20,5,"Comuna:",0);
        $this->Cell(20,5,"".$comuna."",0);   
        $this->Ln();   
        $this->Cell(50,5,"",0);
        $this->Cell(20,5,"Cliente :",0);
        $this->Cell(20,5,"".$cliente."",0);
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);
        $this->Cell(20,5,"Usuario:",0);
        $this->Cell(20,5,"".$rutuser."",0); 
        $this->Ln();
        $this->Cell(50,5,"",0);
        $this->Cell(20,5,"Tipo envio",0);  
        $this->Cell(20,5,"".$tipoenvio."",0);
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);
        $this->Cell(20,5,"C. Interno",0);
        $this->Cell(20,5,"".$cinterno."",0); 
        $this->Ln();
        $this->Cell(50,5,"",0);
        $this->Cell(20,5,"Detalle",0);  
        $this->Cell(20,5,"".$detalle."",0);
        $this->Cell(20,5,"",0);  
        $this->Cell(20,5,"",0);
        $this->Ln();
        $this->Cell(50,10, $this->Image('clases/codigos/'.$code.'.png', $this->GetX(), $this->GetY(),120,30),0);
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $arrayData = array($code, $nsiguimiento, $hora, $dia);
        return $arrayData;
    }

    function generarMasiva($codigo_masivo){

        $pppp = 0;
        $this->correspondencia = new CorrespondenciaModel();
        barcode('clases/codigos/'.$codigo_masivo.'.png', $codigo_masivo, 20, 'horizontal', 'code128', true);
        $ahora = date("Y-m-d H:i:s");
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"",0);  
        $this->Cell(20,10,"",0);
        $this->Cell(20,10,"",0);
        $this->Cell(120,10,"",0); 
        $this->Cell(50,5, $this->Image('clases/logo/logo.jpg', $this->GetX(), $this->GetY(),40,30),0);
        $this->Ln();
        $this->Cell(50,10, $this->Image('clases/codigos/'.$codigo_masivo.'.png', $this->GetX(), $this->GetY(),120,30),0);
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Cell(20,10,"Fecha y hora:",0);
        $this->Cell(20,10,''.$ahora.'',0);
        $this->Ln();
        $this->Cell(60,5,"Destinatario",1);
        $this->Cell(50,5,"Direccion",1);
        $this->Cell(20,5,"Region",1);
        $this->Cell(20,5,"Comuna",1);  
        $this->Cell(60,5,"Detalle",1);  
        $this->Cell(30,5,"Tipo Encomienda",1);
        $this->Cell(40,5,"Codigo Seguimiento",1);   
        $this->Ln();
        //require('modelo/Correspondenciamodel.php');
        $data = $this->correspondencia->buscarCodigoMasivo($codigo_masivo);
        
        foreach($data as $d){

            $nombre = $d['destinatario'];
            $direccion = $d['direccion'];
            $region = $d['regiones'];
            $comuna = $d['comunasCol'];
            $detalle_movimiento = $d['detalle_movimiento'];
            $tipo_encomienda = $d['encomienda'];
            $num_seguimiento = $d['numero_seguimiento'];


            $this->Cell(60,5,"$nombre",1);
            $this->Cell(50,5,"$direccion",1);
            $this->Cell(20,5,"$region",1);  
            $this->Cell(20,5,"$comuna",1);  
            $this->Cell(60,5,"$detalle_movimiento",1);
            $this->Cell(30,5,"$tipo_encomienda",1);
            $this->Cell(40,5,"$num_seguimiento",1); 
            //$this->Cell(35,5,"$suma ",1);  
            $this->Ln();
            $pppp = $pppp + 1 ;    
        }

       

    }

    function informePT1($f_desde, $f_hasta, $Ncartas, $Nvalijas, $Ncajas, $total){

                
        $this->correspondencia = new CorrespondenciaModel();
        $datosInforme  = $this->correspondencia->buscarInformeCorrespondenciaFechas($f_desde, $f_hasta);
        $this->Cell(30,10,"",0);
        $this->Cell(30,10,"",0);
        $this->Cell(30,10,"",0);
        $this->Cell(30,10,"",0);  
        $this->Cell(30,10,"",0);
        $this->Cell(30,10,"",0);
        $this->Cell(30,10,"",0); 
        $this->Cell(60,5, $this->Image('clases/logo/logo.jpg', $this->GetX(), $this->GetY(),40,30),0);
        $this->Ln();
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"Desde :",0);
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"".$f_desde."",0);     
        $this->Ln();
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"Hasta :",0);
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"".$f_hasta."",0);     
        $this->Ln();
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"N° Cartas :",0);
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"".$Ncartas."",0);     
        $this->Ln();
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"N° Valijas :",0);
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"".$Nvalijas."",0);     
        $this->Ln();
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"N° Cajas :",0);
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"".$Ncajas."",0);     
        $this->Ln();
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"Total Encomiendas :",0);
        $this->Cell(20,5,"",0);
        $this->Cell(30,5,"".$total."",0);     
        $this->Ln();
        $this->Cell(40,5,"",0);
        $this->Ln();
        $this->Cell(50,5,"Codigo Barras",1);
        $this->Cell(45,5,"Destinatario",1);
        $this->Cell(30,5,"Direccion",1);
        $this->Cell(20,5,"Comuna",1);  
        //$this->Cell(20,5,"Region",1);  
        $this->Cell(30,5,"Departamento",1);
        $this->Cell(50,5,"Creador",1);   
        $this->Cell(25,5,"Fecha",1); 
        //$this->Cell(30,5,"Hora",1); 
        $this->Cell(25,5,"Estado",1); 
        $this->Ln();

        foreach($datosInforme as $c){
               
            $codigo_barras = $c['codigo_barras'];
            $destinatario = $c['destinatario'];
            $direccion = $c['direccion'];
            $comunas= $c['comunasCol'];
            $regiones = $c['regiones'];
            $departamento = $c['departamento'];
            $nombre_creador = $c['nombre_creador'];
            $fecha = $c['fecha'];
            $hora = $c['hora'];
            $estado = $c['estado'];

            $this->Cell(50,5,"$codigo_barras",1);
            $this->Cell(45,5,"$destinatario",1);
            $this->Cell(30,5,"$direccion",1);  
            $this->Cell(20,5,"$comunas",1);  
            //$this->Cell(20,5,"$regiones",1);
            $this->Cell(30,5,"$departamento",1);
            $this->Cell(50,5,"$nombre_creador",1); 
            $this->Cell(25,5,"$fecha",1);
            //$this->Cell(30,5,"$hora",1);
            $this->Cell(25,5,"$estado",1);
            $this->Ln(); 
             

        }

    }

 

    

}

?>