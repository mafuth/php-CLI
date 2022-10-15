<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailer extends PHPMailer{
    public $Host;
    public $Username;
    public $Password;
    public $Port;

    public function __construct($Host,$Username,$Password,$Port){
        $this->Host = $Host;
        $this->Username = $Username;
        $this->Password = $Password;
        $this->Port = $Port;
    }

    public function sendMail($to,$subject,$body){
        $mail = new PHPMailer(true);
        $return = false;
        try {      
            $mail->isSMTP();
            $mail->Host = $this->Host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->Username;
            $mail->Password = $this->Password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom($this->Username);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            $return = true;
    
        } catch (Exception $e) {
            //echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $return = $mail->ErrorInfo;
        } 
        return $return;
    }
}
