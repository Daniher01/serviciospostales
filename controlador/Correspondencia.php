<?php 

require 'clases/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Correspondencia extends Controller{

    function __construct()
    {
        parent::__construct();
        $this->view->comunas = [];
        $this->view->regiones = [];
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
        $this->view->datosexcel = '';
    }

    function render(){
        $this->Generar();
    }

    function Generar(){
        
        //trae los datos de las comunas
        $this->loadModel('Comunas');
        $comunas = new ComunasModel();
        $this->view->comunas = $comunas->getComunas();
        //trae los datos de las regiones
        $this->loadModel('Region');
        $regiones = new RegionModel();
        $this->view->regiones = $regiones->getRegiones();
        //trae los datos de las regiones
        $this->view->tiepo_encomienda = $this->tipo_encomienda->getTipo_encomienda();
        
        //redireciona a la pagina
        $this->view->render('correspondencia/generar');
    }

    function generarNuevoCliente(){

        //trae los datos del cliente seleccionado
        $this->buscarClienteid();

        $this->view->clientes =  $this->clientemodel->getClienesFrecuentes();
        
        $this->view->tiepo_encomienda = $this->tipo_encomienda->getTipo_encomienda();
        //redireciona a la pagina
        $this->view->render('correspondencia/generar_clientefrecuente');

    }

    function buscarClienteid(){
        if (isset($_GET['idcliente'])){
            $idcliente = (String)$_GET['idcliente'];
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
        if (isset($_GET['n_correspondencia'])){
            $n_correspondencia = (String)$_GET['n_correspondencia'];
            $this->view->correspondencia = $this->model->buscarNumOrden($n_correspondencia);
            if (!empty($this->view->correspondencia)){
                $this->view->destinatario = $this->view->correspondencia[0]['destinatario'];
                $this->view->direccion = $this->view->correspondencia[0]['direccion'];
                $this->view->comunascol = $this->view->correspondencia[0]['comunascol'];
                $this->view->regiones = $this->view->correspondencia[0]['regiones'];
                $this->view->codigo_barras = $this->view->correspondencia[0]['codigo_barras'];
                $this->view->detalle = $this->view->correspondencia[0]['detalle'];
                $this->view->tipo_envio = $this->view->correspondencia[0]['detalle'];
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
        if (isset($_GET['fecha'])){
            $this->view->fecha = (String)$_GET['fecha'];
            $this->view->correspondencia  = $this->model->buscarFecha( $this->view->fecha);
            if (!empty($this->view->correspondencia)){
                $this->view->destinatario = $this->view->correspondencia[0]['destinatario'];
                $this->view->direccion = $this->view->correspondencia[0]['direccion'];
                $this->view->comunascol = $this->view->correspondencia[0]['comunascol'];
                $this->view->regiones = $this->view->correspondencia[0]['regiones'];
                $this->view->codigo_barras = $this->view->correspondencia[0]['codigo_barras'];
                $this->view->detalle = $this->view->correspondencia[0]['detalle'];
                $this->view->tipo_envio = $this->view->correspondencia[0]['detalle'];
            }

            //print_r($this->view->destinatario );

        }
       
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Fecha');
    }

    function addExcel(){
        $this->view->render('correspondencia/correspondenciaMasiva');
    }


    function readExcel(){

        $archivo = $_GET['archivo'];
        //print_r($archivo);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($archivo);
        $worksheet = $spreadsheet->getActiveSheet();
        $this->view->datosexcel = $worksheet;

        $this->view->render('correspondencia/correspondenciaMasiva');
    }

    function generarMasiva(){
        $exceldata = $_POST['exceldata'];
        print_r($_POST);
        $this->view->render('correspondencia/correspondenciaMasiva');
    }


}



?>