<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {
        // Crear el objeto de email, configuracion de casilla
        // $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->Host = 'sandbox.smtp.mailtrap.io';
        // $mail->SMTPAuth = true;
        // $mail->Port = 2525;
        // $mail->Username = 'd085369ca3249d';
        // $mail->Password = '29907ebc88b5c6';

        

        //Probando Brevo/Sendin blue
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.sendinblue.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'tasktrackproject@gmail.com';
        $mail->Password = 'xsmtpsib-8bf29491974f9012e1189d524157cac86297e987df7d9c6b19bc7b433e8a55b7-PywgFsaKn2M5Jpv1';

        // Cabecera del email
        $mail->setFrom('tasktrackproject@gmail.com'); // Aqui iria el dominio del host que estaria pagando
        $mail->addAddress($this->email); // Dirección de destino del email y un nombre asociado
        $mail->Subject = 'Confirma tu cuenta';

        // Cuerpo del email en HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong> Has creado tu cuenta en Uptask, solo debes confirmarla presionando en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='https://uptask2.herokuapp.com/confirmar?token=" . $this->token . "'>Confirmar cuenta </a></p>";
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
        $mail->Host = 'smtp-relay.sendinblue.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'tasktrackproject@gmail.com';
        $mail->Password = 'xsmtpsib-8bf29491974f9012e1189d524157cac86297e987df7d9c6b19bc7b433e8a55b7-PywgFsaKn2M5Jpv1';

        // Cabecera del email
        $mail->setFrom('tasktrackproject@gmail.com'); // Aqui iria el dominio del host que estaria pagando
        $mail->addAddress($this->email); // Dirección de destino del email y un nombre asociado
        $mail->Subject = 'Restablecer contraseña';

        // Cuerpo del email en HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong> Has solicitado restablecer la contraseña, solo debes confirmar presionando en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='https://uptask2.herokuapp.com/restablecer?token=" . $this->token . "'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si vos no solicitaste este cambio, ignora el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }
}
