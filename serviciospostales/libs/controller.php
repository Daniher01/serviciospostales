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

    function existPOST($params){
        foreach ($params as $param){
            if(!isset($_POST[$param])){
                error_log('CONTROLLER::existsPost => No existe el parametro '.$param);
                return false;
            }
        }
        return true;
    }

    function existGET($params){
        foreach ($params as $param){
            if(!isset($_GET[$param])){
                error_log('CONTROLLER::existsGet => No existe el parametro '.$param);
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    function redirect($ruta, $mensajes){
        error_log('CONTROLLER:: redirect');
        $data = [];
        $params = '';

        foreach ($mensajes as $key => $mensaje){
            array_push($data, $key. '='. $mensaje);
        }

        $params = join('%', $data);

        if($params != ''){
            $params = '?'.$params;
        }

        header('Location: '. constant('URL') .$ruta. $params);
    }

    function redirectLogOut($ruta, $mensajes){
        error_log('CONTROLLER:: redirect');
        $data = [];
        $params = '';

        foreach ($mensajes as $key => $mensaje){
            array_push($data, $key. '='. $mensaje);
        }

        $params = join('%', $data);

        if($params != ''){
            $params = '?'.$params;
        }

        header('Location: '. constant('INDEX') .$ruta. $params);
    }
}

?>