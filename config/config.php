<?php 
    //Datos de POSTGRES
    define('SERVER','localhost');
    define('DBNAME', 'pvilches_utalca');
    define('USER','root');
    define('PASSWORD','');
    define('PORT', '33065');

    //definir la zona horaria de chile
    date_default_timezone_set('America/Santiago');

    //definir la url absoluta
    define('URL', 'http://localhost/serviciospostales/')
?>