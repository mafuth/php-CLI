<?php
class tokens {
    private function uniqidReal($lenght) {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
    public function setUUid($lenght){
        if(!isset($_COOKIE['UUID'])){
            $TOKEN = uniqid().''.$this->uniqidReal($lenght);
            $UID = hash('sha256',$TOKEN);
            setcookie('UUID', $UID, 2147483647,'/');
            return $UID;
        }
    }
    public function newToken($lenght){
        $TOKEN = uniqid().''.$this->uniqidReal($lenght);
        return hash('sha256',$TOKEN);
    }
    public function generateCSRF(){
        if (function_exists('mcrypt_create_iv')) {
            $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        } else {
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
}
