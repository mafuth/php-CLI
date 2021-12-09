<?php
class minify{
    
    function compress($data){
        return gzcompress($data);
    }
    function undocompress($data){
        return gzuncompress($data);
    }
    
    function min($data){
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
        
        $buffer = preg_replace($search, $replace, $data);
        $buffer = str_replace(array("\r\n", "\r", "\n"), "", $buffer);
        $buffer = str_replace('<img', '<img loading="lazy"', $buffer);
        
        return $buffer;
    }
}