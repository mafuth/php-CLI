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
    public function setUid($lenght){
        if(!isset($_COOKIE['UID'])){
            $TOKEN = uniqid().''.$this->uniqidReal($lenght);
            $UID = hash('sha256',$TOKEN);
            setcookie('UID', $UID, 2147483647,'/');
        }
    }
    public function newToken($lenght){
        $TOKEN = uniqid().''.$this->uniqidReal($lenght);
        return hash('sha256',$TOKEN);
    }
}
