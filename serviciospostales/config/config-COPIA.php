<?php 
    //Datos de POSTGRES
    define('SERVER','localhost');
    define('DBNAME', 'prueba_utalca');
    define('USER','root');
    define('PASSWORD','');
    define('PORT', '3306');

    //datos de Email
    define('EMAILHOST', 'smtp.gmail.com');
    //define('EMAILUSERNAME', 'serviciospostales@serviciospostales.cl');
    define('EMAILUSERNAME', 'contactoserviciospostales@gmail.com'); //PASS s3rv1c10sP0st@l3s
    define('EMAILPASSWORD','edzwojaczkadnffo');
    define('SMTPSECURE','tls');
    define('EMAILPORT',587);
    define('EMAILNAME', 'Servicios Postales');

    //definir la zona horaria de chile
    date_default_timezone_set('America/Santiago');

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

    //definir la url absoluta
    define('URL', $protocol.$_SERVER['SERVER_NAME'].'/serviciospostales/serviciospostales/');

    define('INDEX', '');
?>
