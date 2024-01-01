<?php 

require '..\PHPMailer\src/PHPMailer.php';
require '..\PHPMailer\src\Exception.php';
require '..\PHPMailer\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Mailer{

    private $phpmailer; 
    public function __construct(){
        $this->phpmailer = new PHPMailer();
        $this->config();
    }

    private function config(){
        ini_set('SMTP','sandbox.smtp.mailtrap.io');
        ini_set('smtp_port',2525);

        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Port = 2525;
        $this->phpmailer->Username = '539659f18e12f5';
        $this->phpmailer->Password = '3a718da697e70d';
    }

    public function sendMail($from, $to, $subject, $message){
        $this->phpmailer->setFrom($from);
        $this->phpmailer->addAddress($to);
        $this->phpmailer->Subject = $subject;
        $this->phpmailer->Body = $message;
        $this->phpmailer->AltBody = $message;

        if (!$this->phpmailer->send()) {
            return 'Mailer Error: ' . $this->phpmailer->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }
}


?>