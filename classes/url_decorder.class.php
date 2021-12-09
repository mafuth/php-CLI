<?php

class url_decorder{

    public $URL;

    function __construct($url) {
        $this->URL = parse_url($url);
        return $this->URL;
      }

    function get_path($i){
        $VALUES = explode('/',$this->URL['path']);
        return $VALUES[$i];
    }

    function get_query(){
        return $this->URL['query'];
    }
}