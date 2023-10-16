<?php

namespace Classes;


use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    protected $nombre;
    protected $email;
    protected $token;
    protected $url;
    protected $mensaje = [];

    public function __construct(string $nombre, string $email, string $token, string $url)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
        $this->url = $url;
    }



    public function enviarEmail()
    {

        //Crear una Instancia de PHPMAILER
        $mail = new PHPMailer();


        try {
            // //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host  = $_ENV['EMAIL_HOST'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $_ENV['EMAIL_USER'];                     //SMTP username
            $mail->Password   = $_ENV['EMAIL_PASS'];                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $_ENV['EMAIL_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('upTask@administrador.com', 'UpTask');
            $mail->addAddress($this->email, $this->nombre);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            //Codificacioon UTF-8
            $mail->CharSet = 'UTF-8';
            //Titulo cuando llega el mensaje antes de entrar al mismo
            $mail->Subject = 'Confirmar tu cuenta';

            //Contenido
            $contenido = "<p>UpTask APP MVC</p>";
            $contenido .= "Nombre: " . $this->nombre . "<br>";
            $contenido .= " Email: " . $this->email . "<br>";
            $contenido .= " TOKEN ACTIVACIÓN: " . $this->token . "<br>";
            $contenido .= "<a href=" . $_ENV["APP_URL"] . $this->url . "?token=" . $this->token . ">Click para Confirmar Cuenta</a>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta o email, ignora el mensaje</p>";

            $mail->Body = $contenido; //Con HTML



            $mail->AltBody = 'Este es un nuevo Email. Buenos Dias'; //Alternativo en caso de que no soporte HTML el servicio de mail

            $resultado = $mail->send();

            $this->mensaje = "Mensaje enviado Correctamente";
            return  $resultado;
        } catch (Exception $e) {
            $this->mensaje = "Mensaje no enviado. Tipo de error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
