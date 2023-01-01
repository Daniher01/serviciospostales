<?php 
    //Datos de POSTGRES
    define('SERVER','localhost');
    define('DBNAME', '');
    define('USER','root');
    define('PASSWORD','');
    define('PORT', '');

    //datos de Email
    define('EMAILHOST', 'smtp.gmail.com');
    define('EMAILUSERNAME', 'infoserviciospostales@gmail.com');
    define('EMAILPASSWORD','');
    define('SMTPSECURE','tls');
    define('EMAILPORT','');
    define('EMAILNAME', 'Servicios Postales');

    //definir la zona horaria de chile
    date_default_timezone_set('America/Santiago');

    //definir la url absoluta
    define('URL', 'http://localhost/serviciospostales/')
?>
