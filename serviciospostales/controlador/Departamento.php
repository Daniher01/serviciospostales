<?php 

class Departamento extends SessionController{


    function __construct()
    {
        parent::__construct();
        $this->view->departamentos = [];
    }

    function render(){
        $this->agregar();
        
    }

    function agregar(){

        if(isset($_POST['departamento'])){
            $departamento = $_POST['departamento'];
            $this->model->agregarDepartamento($departamento);
        }

        $this->view->departamentos = $this->model->getDepartamentos();
        $this->view->render('departamento/agregar');
    }
}

?>