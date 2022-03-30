<?php 

class Controller{

    function __construct()
    {
        $this->view = new View();
    }

    function loadModel($model){
        try{
            $url = 'modelo/'.$model.'model.php';

            if(file_exists($url)){
                require $url;
    
                $modelName = $model.'Model';
                $this->model = new $modelName();
            }
        }catch (Error $e){
            error_log("APP::Controller Base-> $e");
        }

    }
}

?>