<?php 
//Datos de la BD
include_once('config/config.php');

class Database{
    
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = constant('SERVER');
        $this->db = constant('DBNAME');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->port = constant('PORT');
    }

    function connect(){
        try{
            $connetion = 'mysql:host='.$this->host.';dbname='.$this->db.';port='.$this->port;
            $options = [
                PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES  =>false,  
            ];

            $conn = new PDO($connetion,$this->user,$this->password, $options);

            return $conn;

        }catch(PDOException $e){
            $e = $e->getMessage();
            error_log("ERROR DE CONEXION: $e");
        }
    }


}
?>