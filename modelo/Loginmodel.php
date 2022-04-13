<?php 
    class LoginModel extends Model{

        public function __construct()
        {   
            parent::__construct();
            error_log('Construct::LoginModel');
            
        }

         //Iniciar Sesion
        public function InicioSesionUsuario(String $_rut, String $_password){

            try{
                
                $this->idusuario = 0;
                $this->rut=$_rut;
                $this->password=$_password;
                $this->inicio = false;
                $this->mensaje = ' ';
                $this->resultado = [];

                //se consulta por la password
                $query1 = 'SELECT password FROM usuario WHERE rut=?';
                $obtienePass =$this->db->connect()->prepare($query1);
                $arrayData = array($this->rut);
                $obtienePass->execute($arrayData);
                $resultado = $obtienePass->fetch(PDO::FETCH_ASSOC);
                if(empty($resultado)){
                    //no se obtienen valores
                    $this->inicio = false;
                    $this->mensaje = 'Usuario no encontrado';
                    error_log($this->mensaje);

                }else{
                    //compara la password ingresada con la de la BD
                    if($this->password == $resultado['password']){
                        //se obtienen los datos para asociarlos a la sesion
                        $query2 = 'SELECT idUsuario, username, password,rut, nombre_usuario, apellido_p, apellido_m, email, tipo_usuario_idtipo_usuario, tipo_departamento FROM usuario  WHERE rut=?';
                        //se prepara la consulta
                        $obtieneDatos =$this->db->connect()->prepare($query2);
                        $arrayData = array($this->rut);
                        $obtieneDatos->execute($arrayData);
                        $resultado1 = $obtieneDatos->fetchAll(PDO::FETCH_ASSOC);
                        error_log('LoginModel::login->success');
                        //inicio de sesion

                        return $resultado1;
                    }  else{
                        error_log('Password no es igual');
                        // contraseña incorrecta 
                    
                        return NULL; 
                    }  

                }
                //$this->resultado = array($this->inicio, $this->mensaje);
                
            }catch (PDOException $e){
                return NULL;
                $e= $e->getMessage();
                error_log("$e"); 
            }
        }

    }


?>