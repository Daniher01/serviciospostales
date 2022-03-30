<?php 

class Correspondencia extends Controller{

    function __construct()
    {
        parent::__construct();
        $this->view->comunas = [];
        $this->view->regiones = [];
        $this->view->tiepo_encomienda = [];
        $this->view->clienteid = [];
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
        $this->view->render('correspondencia/buscar_id');
    }

    function buscarId(){
        if (isset($_GET['n_correspondencia'])){
            $n_correspondencia = (String)$_GET['n_correspondencia'];
            //$this->view->render('recepcionista/main_recep');
        }
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Id');
    }

    function buscarFecha(){
       
        //redirecciona la pagina
        $this->view->render('correspondencia/buscar_Fecha');
    }


}



?>