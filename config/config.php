<?php 
    //Datos de POSTGRES
    define('SERVER','localhost');
    define('DBNAME', 'pvilches_utalca');
    define('USER','root');
    define('PASSWORD','');
    define('PORT', '33065');

    //datos de Email
    define('EMAILHOST', 'smtp.gmail.com');
    define('EMAILUSERNAME', 'infoserviciospostales@gmail.com');
    define('EMAILPASSWORD','@infoserviciospostales1234');
    define('SMTPSECURE','tls');
    define('EMAILPORT',587);
    define('EMAILNAME', 'Servicios Postales');

    //definir la zona horaria de chile
    date_default_timezone_set('America/Santiago');

    //definir la url absoluta
    define('URL', 'http://localhost/serviciospostales/')
?>