<?php 
    error_reporting(E_ALL); //Error/Excepcion siempre usar E_ALL

    ini_set('ignore_repeated_errors', TRUE); //siempre usa true

    ini_set('display_erros', FALSE); //muestra Error/Excepcion solo en produccion ***
    
    ini_set('log_erros', TRUE); //registros del error

    ini_set('error_log', 'php-error.log');

  

    require_once 'libs/database.php';
    require_once 'libs/controller.php';
    require_once 'clases/sessionController.php';
    require_once 'libs/view.php';
    require_once 'libs/model.php';
    require_once 'libs/app.php';

    require_once 'config/config.php';
    
    error_log('inicio de aplicacion web');

    

    $app = new App();



?>