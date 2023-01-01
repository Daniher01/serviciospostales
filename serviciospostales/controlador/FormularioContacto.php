<?php 

class FormularioContacto extends Controller{
    
    function enviarFormulario(){
        print_r($_POST);

        $email_formulario = $_POST['email'];
        $estimado_formulario = $_POST['name'];
        $asunto = $_POST['subject'];
        $mensaje_formulario = $_POST['message'];

        $email ='servicios.postales@hotmail.com';
        $html = '<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Mi mensaje es el siguiente: '.$mensaje_formulario;

        /*
        crear variable html y enviar donde dice msj
        */

        include_once "EMAIL/enviarEMAIL.php";
        $this->email = new EMAIL();
        $this->email->sendEmail_formulario($email,null,$email_formulario, $asunto,$estimado_formulario, $html);

        header('Location: '.'http://serviciospostales.cl/serviciospostales/');
    }
}

?>