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

	function sendEmail($mail_addAddress,$mail_cc=null,$mail_subject, $estimado,  $dataHTML){

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

		$html = 
                '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="x-apple-disable-message-reformatting">
                    <title></title>
                    <!--[if mso]>
                    <noscript>
                        <xml>
                            <o:OfficeDocumentSettings>
                                <o:PixelsPerInch>96</o:PixelsPerInch>
                            </o:OfficeDocumentSettings>
                        </xml>
                    </noscript>
                    <![endif]-->
                    <style>
                        table, td, div, h1, p {font-family: Arial, sans-serif;}
                    </style>
                </head>
                <body style="margin:0;padding:0;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                        <tr>
                            <td align="center" style="padding:0;">
                                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                                    <tr>
                                        <td align="center" style="padding:0px 0 0px 0;background:#70bbd9;">
                                            <img src="http://pvilches.cl/postal/json/img/header.jpg" style="height:auto;display:block;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:36px 30px 42px 30px;">
                                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                                    <td style="padding:0 0 36px 0;color:#153643;">
                                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Estimado: <h3>' .$estimado.'</h3></h1>									
                                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Adjunto con saludarle, para informarle que ha sido emitido el documento solicitado, a continuacion tendra la informacion detallada del documento</p>
                                                        <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="'.constant('URL').'" style="color:#ee4c50;text-decoration:underline;">Generar Aqui</a></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0;">
															
															'.$dataHTML.'
                
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:30px;background:#4a9cf4;">
                                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                                <tr>
                                                    <td style="padding:0;width:50%;" align="left">
                                                        <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                                            &reg; Servicios Postales Ltda.<br/><a href="#" style="color:#ffffff;text-decoration:underline;">Sitio web</a>
                                                        </p>
                                                    </td>
                                                    <td style="padding:0;width:50%;" align="right">
                                                        <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                                            <tr>
                                                                <td style="padding:0 0 0 10px;width:38px;">
                                                                    <a href="http://www.twitter.com/" style="color:#ffffff;"></a>
                                                                </td>
                                                                <td style="padding:0 0 0 10px;width:38px;">
                                                                    <a href="http://www.facebook.com/" style="color:#ffffff;"></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>';
		
		//contenido del correo
		$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
		$mail->Subject = $mail_subject; //asunto
		$mail->Body = '';     //mensaje del correo
		$mail->msgHTML($html); //html con el mensaje
		//permite enviar varios archivos a la vez
		/*if(is_array($archivos)){
			foreach($archivos as $archivo){
				$mail->addAttachment($archivo);
			}
		}else{
			$mail->addAttachment($archivos);
		}*/
		$mail->CharSet = 'UTF-8';       //para que permita las tildes
		//$mail->msgHTML($message); //html con el mensaje
	
		if(!$mail->send()) { //si el mensaje se envio
			
			error_log('Error de correo: ' . $mail->ErrorInfo);
	
		} else { //si el mensaje no se pudo enviar
			error_log('Email enviado Correctamente');
			
		}
	}

    function sendEmail_formulario($mail_addAddress,$mail_cc=null,$mail_form, $mail_subject, $estimado,  $dataHTML){

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

		$html = 
                '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="x-apple-disable-message-reformatting">
                    <title></title>
                    <!--[if mso]>
                    <noscript>
                        <xml>
                            <o:OfficeDocumentSettings>
                                <o:PixelsPerInch>96</o:PixelsPerInch>
                            </o:OfficeDocumentSettings>
                        </xml>
                    </noscript>
                    <![endif]-->
                    <style>
                        table, td, div, h1, p {font-family: Arial, sans-serif;}
                    </style>
                </head>
                <body style="margin:0;padding:0;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                        <tr>
                            <td align="center" style="padding:0;">
                                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                                    <tr>
                                        <td align="center" style="padding:0px 0 0px 0;background:#70bbd9;">
                                            <img src="http://pvilches.cl/postal/json/img/header.jpg" style="height:auto;display:block;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:36px 30px 42px 30px;">
                                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                                    <td style="padding:0;color:#153643;">
                                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Gusto en saludarle, soy '.$estimado.'</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0;">
															'.$dataHTML.'
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td style="padding:0 0 36px 0;color:#153643;">
                                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Este es mi email de contacto: '.$mail_addAddress.'								
                                                </td>
                                            </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:30px;background:#4a9cf4;">
                                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                                <tr>
                                                    <td style="padding:0;width:50%;" align="left">
                                                        <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                                            &reg; Servicios Postales Ltda.<br/><a href="#" style="color:#ffffff;text-decoration:underline;">Sitio web</a>
                                                        </p>
                                                    </td>
                                                    <td style="padding:0;width:50%;" align="right">
                                                        <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                                            <tr>
                                                                <td style="padding:0 0 0 10px;width:38px;">
                                                                    <a href="http://www.twitter.com/" style="color:#ffffff;"></a>
                                                                </td>
                                                                <td style="padding:0 0 0 10px;width:38px;">
                                                                    <a href="http://www.facebook.com/" style="color:#ffffff;"></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>';
		
		//contenido del correo
		$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
		$mail->Subject = $mail_subject; //asunto
		$mail->Body = '';     //mensaje del correo
		$mail->msgHTML($html); //html con el mensaje
		//permite enviar varios archivos a la vez
		/*if(is_array($archivos)){
			foreach($archivos as $archivo){
				$mail->addAttachment($archivo);
			}
		}else{
			$mail->addAttachment($archivos);
		}*/
		$mail->CharSet = 'UTF-8';       //para que permita las tildes
		//$mail->msgHTML($message); //html con el mensaje
	
		if(!$mail->send()) { //si el mensaje se envio
			
			error_log('Error de correo: ' . $mail->ErrorInfo);
	
		} else { //si el mensaje no se pudo enviar
			error_log('Email enviado Correctamente');
			
		}
	}
}



?>