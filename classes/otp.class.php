<?php
class otp{

    const INPUT_ENC_METHOD = "AES-256-CBC";
    const KEY_ENC_METHOD = "SHA256";

    private $app_key;    
    private $iv;
    private $n;

    public function generate_otp(){
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $this->n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        setcookie('temp', base64_encode(openssl_encrypt($result, self::INPUT_ENC_METHOD, $this->app_key, 0, $this->iv)), time() + 120,'/');
        return $result;
    }
    public function verify_otp($OTP){
        $COOKIE_OTP = openssl_decrypt(base64_decode($_COOKIE['temp']), self::INPUT_ENC_METHOD, $this->app_key, 0, $this->iv);
        if($OTP == $COOKIE_OTP){
            return true;
        }else{
            return false;
        }
    }

    public function __construct($KEY1,$KEY2,$N){
        $this->app_key = hash( self::KEY_ENC_METHOD, $KEY1);
        $this->iv = substr(hash(self::KEY_ENC_METHOD, $KEY2),0,16);
        $this->n = $this->n;
    }
}