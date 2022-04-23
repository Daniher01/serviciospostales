<!--Author: Obed Alvarado
Author URL: http://obedalvarado.pw
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/ !-->
<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class EMAIL extends PHPMailer{

	function sendEmail($mail_addAddress,$mail_cc=null,$txt_message,$mail_subject, $archivos){

		//datos para conectarse al correo de quien envia
		$mail = new PHPMailer;
		$mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
		$mail->Host = constant('EMAILHOST');             // Especificar el servidor de correo a utilizar 
		$mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
		$mail->Username = constant('EMAILUSERNAME');          // Correo electronico saliente ejemplo: tucorreo@gmail.com
		$mail->Password = constant('EMAILPASSWORD'); 		// Tu contraseña de gmail
		$mail->SMTPSecure = constant('SMTPSECURE');                  // Habilitar encriptacion, `ssl` es aceptada
		$mail->Port = constant('EMAILPORT');                          // Puerto TCP  para conectarse 
		$mail_setFromName=constant('EMAILNAME'); 					 //nombre de quien envia el correo
	
		//datos para el envio de correo
		$mail->setFrom($mail->Username, $mail_setFromName);//datos para el envio de correo (email, nombre de quien envia)
		$mail->addReplyTo($mail->Username, $mail_setFromName);//datos el correo que va a recibir la respuesta (email, nombre de quien recibe la respuesta)
		$mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
	
		if ($mail_cc != null){
			$i = 0;
			while($mail_cc[$i] != NULL){
				$mail->addCC($mail_cc[$i]);
				$i++;
			}
		}
		
		//contenido del correo
		$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
		$mail->Subject = $mail_subject; //asunto
		$mail->Body = $txt_message;     //mensaje del correo

		//permite enviar varios archivos a la vez
		if(is_array($archivos)){
			foreach($archivos as $archivo){
				$mail->addAttachment($archivo);
			}
		}else{
			$mail->addAttachment($archivos);
		}
		$mail->CharSet = 'UTF-8';       //para que permita las tildes
		//$mail->msgHTML($message); //html con el mensaje
	
		if(!$mail->send()) { //si el mensaje se envio
			
			error_log('Error de correo: ' . $mail->ErrorInfo);
	
		} else { //si el mensaje no se pudo enviar
			error_log('Email enviado Correctamente');
			
		}
	}

	//$this->sendEmail('daniel.hernandez.me@cftsa.cl','este es un mensaje de prueba','asunto' );
}



//if (isset($_POST['send'])){
	
	/*
	$mail_cc = $_POST['Cc_email'];
	$mail_addAddress=$_POST['customer_email']; //correo al que envia
	$txt_message=$_POST['message'];
	$mail_subject=$_POST['subject'];
	if($_FILES['archivo']){
		$nombre_base = basename($_FILES['archivo']['name']);
		$nombre_final = date("d-m-y").'_'. date('H-i-s').'_'. $nombre_base;
		$ruta = 'files/'. $nombre_final;
		$subirArcvhio = move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
	}*/
	//print_r($_POST);

	//$this->sendemail($mail_addAddress,$mail_cc,$txt_message,$mail_subject, $ruta);//Enviar el mensaje
//}


?>