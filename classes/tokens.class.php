<?php
class tokens {
    const INPUT_ENC_METHOD = "AES-256-CBC";
    const KEY_ENC_METHOD = "SHA256";

    private $app_key;    
    private $iv;
    private $lenght;

    public function __construct($KEY1,$KEY2,$N){
        $this->app_key = hash( self::KEY_ENC_METHOD, $KEY1);
        $this->iv = substr(hash(self::KEY_ENC_METHOD, $KEY2),0,16);
        $this->lenght = $N;
    }

    private function uniqidReal() {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($this->lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($this->$lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $this->$lenght);
    }
    public function setUid(){
        if(!isset($_COOKIE['UID'])){
            $CSRF_RAND = uniqid().''.uniqidReal();
            $UID = base64_encode(openssl_encrypt($CSRF_RAND, self::INPUT_ENC_METHOD, $this->app_key, 0, $this->iv));
            setcookie('UID', $UID, 2147483647,'/');
        }
    }
}