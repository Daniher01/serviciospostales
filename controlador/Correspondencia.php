<?php 

require 'clases/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Correspondencia extends SessionController{

    function __construct()
    {
        parent::__construct();
        $this->view->comunas = [];
        $this->view->regiones = [];
        $this->view->departamentos = [];
        $this->view->tiepo_encomienda = [];
        $this->view->clienteid = [];
        $this->view->correspondencia = [];
        $this->view->fecha = '';
        $this->loadModel('ClientesFrecuentes');
        $this->clientemodel = new ClientesFrecuentesModel();
        $this->loadModel('Tipo_encomienda');
        $this->tipo_encomienda = new Tipo_encomiendaModel();


        //variables para mostrar los datos del clientes
        $this->view->var_id = '';
        $this->view->var_nombre ='';
        $this->view->var_direccion ='';
        $this->view->var_comuna ='';
        $this->view->var_comunaid ='';
        $this->view->var_region ='';

        //variables para mostrar los datos de la correspondencia buscada
        $this->view->destinatario = '';
        $this->view->direccion = '';
        $this->view->comunascol = '';
        $this->view->regiones = '';
        $this->view->codigo_barras = '';
        $this->view->detalle = '';
        $this->view->tipo_envio = '';


        //mostrar los datos del excel
        $this->view->datosexcel = [];
        $this->view->numeroMayorDeFila = [];

        //datos para el informe
        $this->view->datosInforme = [];
        $this->view->f_desde = '';
        $this->view->f_hasta = '';
        $this->view->Ncarta = '';
        $this->view->Nvalija = '';
        $this->view->Ncaja = '';
        $this->view->totalEncomiendas = '';
    }

    function render(){
        $this->Generar();
    }

    function getComunas(){
        $idregion = $_POST['idregion'];
        //echo $idregion;
        $this->loadModel('Comunas');
        $comunas = new ComunasModel();
        $comuna= $comunas->getcomunasIdRegion($idregion);

        foreach ($comuna as $c){

            echo '<option value=" '. $c['idComunas'].'  "> '. $c['Comunascol'].' </option>';
        }

    }

    function Generar(){
        
        //trae los datos de las comunas
        /*$this->loadModel('Comunas');
        $comunas = new ComunasModel();
        $this->view->comunas = $comunas->getComunas();*/
        //trae los datos de las regiones
        $this->loadModel('Region');
        $regiones = new RegionModel();
        $this->view->regiones = $regiones->getRegiones();
        //trae los datos de los departamentos
        $this->loadModel('Departamento');
        $departamentos = new DepartamentoModel();
        $this->view->departamentos = $departamentos->getDepartamentos();
        //trae los datos de las regiones
        $this->view->tiepo_encomienda = $this->tipo_encomienda->getTipo_encomienda();
        
        //redireciona a la pagina
        $this->view->render('correspondencia/generar');
    }

    function generarNuevoCliente(){

        $iduser = $_SESSION['idusuario'];

        //trae los datos del cliente seleccionado
        $this->buscarClienteid();

        $this->view->clientes =  $this->clientemodel->getClienesFrecuentes($iduser);
        
        $this->view->tiepo_encomienda = $this->tipo_encomienda->getTipo_encomienda();
        //redireciona a la pagina
        $this->view->render('correspondencia/generar_clientefrecuente');

    }

    function buscarClienteid(){
        if (isset($_POST['idcliente'])){
            $idcliente = (String)$_POST['idcliente'];
            $this->view->clienteid =  $this->clientemodel->getClienesFrecuentesId($idcliente);
            foreach ( $this->view->clienteid  as $c){
                $this->view->var_id = $c['idcliente_frecuentes'];
                $this->view->var_nombre =$c['nombre'];
                $this->view->var_direccion =$c['direccion'];
                $this->view->var_comuna =$c['comunascol'];
                $this->view->var_comunaid =$c['Comunas_idComunas'];
                $this->view->var_region =$c['regiones'];
            }
 
        }
    }


    function Buscar(){
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Id');
    }

    function buscarId(){
        if (isset($_POST['n_correspondencia'])){
            $n_correspondencia = (String)$_POST['n_correspondencia'];
            $this->view->correspondencia = $this->model->buscarNumOrden($n_correspondencia);
            if (!empty($this->view->correspondencia)){
                $this->view->destinatario = $this->view->correspondencia[0]['destinatario'];
                $this->view->direccion = $this->view->correspondencia[0]['direccion'];
                $this->view->comunascol = $this->view->correspondencia[0]['comunascol'];
                $this->view->regiones = $this->view->correspondencia[0]['regiones'];
                $this->view->codigo_barras = $this->view->correspondencia[0]['codigo_barras'];
                $this->view->detalle = $this->view->correspondencia[0]['detalle'];
                $this->view->tipo_envio = $this->view->correspondencia[0]['encomienda'];
            }
            //print_r($this->view->destinatario );
            
           //print_r($this->view->correspondencia);
        }
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Id');
    }

    public function fecha(){
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Fecha');
    }

    function buscarFecha(){
        if (isset($_POST['f_desde']) && isset($_POST['f_hasta'])){
            $f_desde = (String)$_POST['f_desde'];
            $f_hasta = (String)$_POST['f_hasta'];
            $this->view->correspondencia  = $this->model->buscarFecha($f_desde, $f_hasta);


            //print_r( $this->view->correspondencia );

        }
       
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Fecha');
    }

    function buscarDestinatario(){
        if (isset($_POST['destinatario'])){
            $destinatario = (String)$_POST['destinatario'];
            $this->view->correspondencia  = $this->model->buscarDestinatario($destinatario);
        }
       
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_destinatario');
    }

    function buscarUsuarioGenerado(){
        if (isset($_POST['usuario'])){
            $usuario = (String)$_POST['usuario'];
            $this->view->correspondencia  = $this->model->buscarUsuarioQueLoGenero($usuario);
        }
       
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_usuario_que_lo_genero');
    }

    function addExcel(){
        $this->view->render('correspondencia/correspondenciaMasiva');
    }


    function readExcel(){

        $archivo = $_FILES['archivo']['name']; //FILES
        $ruta = 'files/correspondencia masiva/'.$archivo;
        move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($ruta);
        $documento = $spreadsheet->getSheet(0);

        # Calcular el máximo valor de la fila como entero, es decir, el
        # límite de nuestro ciclo
        $this->view->numeroMayorDeFila = $documento->getHighestRow(); // Numérico
        $letraMayorDeColumna = $documento->getHighestColumn(); // Letra

        $this->view->archivo = $ruta;
        $this->view->nombre = [];
        $this->view->direccion = [];
        $this->view->region = [];
        $this->view->comuna = [];
        $this->view->detalle = [];
        $this->view->tipo_encomienda = [];

        // Recorrer filas; comenzar en la fila 2 porque omitimos el encabezado
        for ($indiceFila = 2; $indiceFila <=  $this->view->numeroMayorDeFila; $indiceFila++) {

            # Las columnas están en este orden:
            # Código de barras, Descripción, Precio de Compra, Precio de Venta, Existencia
            array_push($this->view->nombre, $documento->getCellByColumnAndRow(1, $indiceFila)) ;
            array_push($this->view->direccion, $documento->getCellByColumnAndRow(2, $indiceFila)) ;
            array_push($this->view->region, $documento->getCellByColumnAndRow(3, $indiceFila)) ;
            array_push($this->view->comuna, $documento->getCellByColumnAndRow(4, $indiceFila)) ;
            array_push($this->view->detalle, $documento->getCellByColumnAndRow(5, $indiceFila)) ;
            array_push($this->view->tipo_encomienda, $documento->getCellByColumnAndRow(6, $indiceFila)) ;

            
        }

        //unlink($archivo);

        $this->view->render('correspondencia/correspondenciaMasiva');
    }

    function generarInforme(){

        if (isset($_POST['f_desde']) && isset($_POST['f_hasta'])){
            $f_desde = (String)$_POST['f_desde'];
            $f_hasta = (String)$_POST['f_hasta'];

            $this->view->f_desde = $f_desde;
            $this->view->f_hasta = $f_hasta;
            
            $this->view->datosInforme  = $this->model->buscarInformeCorrespondenciaFechas($f_desde, $f_hasta);

            $this->view->Ncarta =  $this->tipo_encomienda->totalEncomienda('Sobre',$f_desde, $f_hasta);
            
            $this->view->Nvalija =  $this->tipo_encomienda->totalEncomienda('balija',$f_desde, $f_hasta);
            
            $this->view->Ncaja =  $this->tipo_encomienda->totalEncomienda('Caja',$f_desde, $f_hasta);

            $this->view->Ncarta =  $this->view->Ncarta[0]['total'];
            $this->view->Nvalija =  $this->view->Nvalija[0]['total'];
            $this->view->Ncaja =  $this->view->Ncaja[0]['total'];

            $this->view->totalEncomiendas = $this->view->Ncarta + $this->view->Nvalija + $this->view->Ncaja;


            //print_r( $this->view->datosInforme );

        }
        $this->view->render('correspondencia/informe');
    }

}



?>