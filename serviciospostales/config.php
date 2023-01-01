<?php 
    //Datos de POSTGRES
    define('SERVER','localhost');
    define('DBNAME', 'u614325207_spostal');
    define('USER','u614325207_userspostal');
    define('PASSWORD','AJC1718pr@');
    define('PORT', '3306');

    //datos de Email
    define('EMAILHOST', 'smtp.titan.email');
    define('EMAILUSERNAME', 'serviciospostales@serviciospostales.cl');
    define('EMAILPASSWORD','$fdffh%/&(/d');
    define('SMTPSECURE','tls');
    define('EMAILPORT',587);
    define('EMAILNAME', 'Servicios Postales');

    //definir la zona horaria de chile
    date_default_timezone_set('America/Santiago');

    //definir la url absoluta
    define('URL', 'http://serviciospostales.cl/serviciospostales/')
?>