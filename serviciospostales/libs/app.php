<?php 
require_once 'controlador/Error.php';
class App{

    function __construct()
    {
    
        try{
            //verifica que exista la url 
            $url = isset($_GET['url']) ? $_GET['url']: null; 
            $url = rtrim($url, '/');
            $url = explode('/', $url);


            //solo si se genera el PDF  
            if($url[0]=='PDFController'){
                error_log('app pdf');
                $archivoController = 'controlador/PDFController.php';
                require_once $archivoController;
                $controller = new PDFController;

                $nparam = sizeof($url);

                if($nparam > 1){
                    if($nparam > 2){
                        $param = [];
                        for($i=2; $i<$nparam; $i++){
                            array_push($param, $url[$i]);
                        }
                        $controller->{$url[1]}($param);
                    }else{
                        $controller->{$url[1]}();
                    }
                }

            }


            
            //si la url esta vacia
            if(empty($url[0]) || $url[0] =='Login' ){
                //require_once 'vista/layouts/header.php';
                error_log('APP::construct-> no hay controlador especificado');
                $archivoController = 'controlador/Login.php';
                require_once $archivoController;
                $controller = new Login();
                $controller->loadModel('Login');  /* DEFINIR EL MAIN DE LA PAGINA */
                $controller->render();

                $nparam = sizeof($url);

                if($nparam > 1){
                    if($nparam > 2){
                        $param = [];
                        for($i=2; $i<$nparam; $i++){
                            array_push($param, $url[$i]);
                        }
                        $controller->{$url[1]}($param);
                    }else{
                        $controller->{$url[1]}();
                    }
                }
                return false;

            }elseif($url[0]=='PDFController'){
                error_log('app pdf');
                $archivoController = 'controlador/PDFController.php';
                require_once $archivoController;
                $controller = new PDFController;

                $nparam = sizeof($url);

                if($nparam > 1){
                    if($nparam > 2){
                        $param = [];
                        for($i=2; $i<$nparam; $i++){
                            array_push($param, $url[$i]);
                        }
                        $controller->{$url[1]}($param);
                    }else{
                        $controller->{$url[1]}();
                    }
                }


            }elseif($url[0]!='PDFController' && $url[0] !='Login'){
                //require_once 'vista/layouts/header.php';
                error_log('app otra vista');
                //cuando ya existe una url
                $archivoController = 'controlador/'. $url[0] . '.php';

                if(file_exists($archivoController)){
                    require_once $archivoController;

                    //inicializa el controlador
                    $controller = new $url[0];
                    $controller->loadModel($url[0]);

                    //numero de elementos del arreglo (la cantidad de parametros que recibe un posible metodo)
                    $nparam = sizeof($url);

                    if($nparam > 1){
                        if($nparam > 2){
                            $param = [];
                            for($i=2; $i<$nparam; $i++){
                                array_push($param, $url[$i]);
                            }
                            $controller->{$url[1]}($param);
                        }else{
                            $controller->{$url[1]}();
                        }
                    }else{
                        $controller->render();
                    }
                
                }else{ //si no existe el controlador

                    $controller = new Errores('no existe el controlador');
                    
                }
                
            }
            
            
        }catch(Error $e){
            $controller = new Errores($e);
            
        }
    }
}



?>