<?php

namespace App\Services\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {

    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 587;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->SMTPAuth = true;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Username = EMAIL;
        $this->mail->Password = EMAIL_PASSWORD;
        $this->mail->setFrom($this->mail->Username, SITE_NAME);
    }

    public function sendRecoveryPassword($user, int $code){
        try{
            $this->mail->Subject = 'Recuperação de senha';

            $this->mail->addAddress($user->email, $user->nome);

            ob_start();
                $nome = $user->nome;
                $codigo = $code;
                include __DIR__ . '/../../Resources/Emails/recovery-password.php';
            $file = ob_get_clean();

            $this->mail->isHTML(true);
            $this->mail->Body = $file;

            $this->mail->send();

            return true;

        }catch(Exception $e){
            return $e;
        }
    }



}