<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $nombre;
    public $apellido;
    public $email;
    public $token;

    public function __construct($nombre, $apellido, $email, $token)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {

        //Probando Brevo/Sendin blue
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        // Cabecera del email
        $mail->setFrom('tasktrackproject@gmail.com'); // Aqui iria el dominio del host que estaria pagando
        $mail->addAddress($this->email); // Dirección de destino del email y un nombre asociado
        $mail->Subject = 'Confirma tu cuenta';

        // Cuerpo del email en HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . " " . $this->apellido . "</strong> Has creado tu cuenta en TaskTrack, solo debes confirmarla presionando en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['HOST'] . "/confirmar?token=" . $this->token . "'>Confirmar cuenta </a></p>";
        $contenido .= "<p>Si vos no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;


        // Enviar el email
        $mail->send(); 
        
    }
    public function enviarInstrucciones(){
        // Crear el objeto de email, configuracion de casilla
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        // Cabecera del email
        $mail->setFrom('tasktrackproject@gmail.com'); // Aqui iria el dominio del host que estaria pagando
        $mail->addAddress($this->email); // Dirección de destino del email y un nombre asociado
        $mail->Subject = 'Restablecer contraseña';

        // Cuerpo del email en HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . " " . $this->apellido . "</strong> Has solicitado restablecer la contraseña, solo debes confirmar presionando en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['HOST'] . "/restablecer?token=" . $this->token . "'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si vos no solicitaste este cambio, ignora el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }
}
