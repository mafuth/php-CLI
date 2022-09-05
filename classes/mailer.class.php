<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailer extends PHPMailer{
    private $Host;
    private $Username;
    private $Password;
    private $Port;

    public function __construct($Host,$Username,$Password,$Port){
        $this->Host = $Host;
        $this->Username = $Username;
        $this->Password = $Password;
        $this->Port = $Port;
    }

    public function send($from,$to,$subject,$body){
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
            $mail->setFrom($from);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            $return = true;
    
        } catch (Exception $e) {
            //echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $return = false;
        } 
        return $return;
    }
}