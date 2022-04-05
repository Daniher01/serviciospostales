<?php 
    //Datos de POSTGRES
    define('SERVER','localhost');
    define('DBNAME', 'pvilches_serverspostal');
    define('USER','pvilches_serveruser');
    define('PASSWORD','YPN4ewlSDr');
    define('PORT', '3306');

    //definir la zona horaria de chile
    date_default_timezone_set('America/Santiago');

    //definir la url absoluta
    define('URL', 'http://pvilches.cl/postal/')
?>