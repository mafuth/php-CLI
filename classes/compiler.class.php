<?php
class compiler{
    
    function compress($data){
        return gzcompress($data);
    }
    function undocompress($data){
        return gzuncompress($data);
    }
    
    function output($data,$min){
        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );
        $buffer = $data;
        if($min == true){
            $buffer = preg_replace($search, $replace, $buffer);
            $buffer = str_replace(array("\r\n", "\r", "\n"), "", $buffer);
        }
        $buffer = str_replace('<form', '<form enctype="multipart/form-data"', $buffer);
        $buffer = str_replace('</form>', '<input type="hidden" name="csrf" value="'.$_SESSION['token'].'"></form>', $buffer);
        $buffer = str_replace('<img', '<img loading="lazy"', $buffer);
        
        return $buffer;
    }
}