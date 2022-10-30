<?php
class compiler{
    
    public function compress($data){
        return gzcompress($data);
    }
    public function undocompress($data){
        return gzuncompress($data);
    }

    public function output($input,$min){
        if($min == true){
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
            $buffer = $input;
            if($min == true){
                $buffer = preg_replace($search, $replace, $buffer);
                $buffer = str_replace(array("\r\n", "\r", "\n"), "", $buffer);
            }
            $buffer = str_replace('<form', '<form enctype="multipart/form-data"', $buffer);
            $buffer = str_replace('</form>', '<input type="hidden" name="csrf" value="'.$_SESSION['token'].'"></form>', $buffer);
            $buffer = str_replace('<img', '<img loading="lazy"', $buffer);
            $buffer = str_replace('<LINK', '<a onclick="lazyPageLoad(this),event.preventDefault()"', $buffer);
            $buffer = str_replace('</LINK', '</a', $buffer);
            $buffer = str_replace('</head', '<link rel="https://unpkg.com/nprogress@0.2.0/nprogress.css"/></head', $buffer);
        }
        echo '<!doctype html><html lang="en">'.$buffer.'<script>function lazyPageLoad(object){var xhttp = new XMLHttpRequest();xhttp.onreadystatechange = function() {if (this.readyState == 4 && this.status == 200) {document.documentElement.innerHTML= xhttp.responseText;window.history.pushState("", "", object.href);}};document.documentElement.innerHTML= "";xhttp.open("GET", object.href, true);xhttp.send();}</script></html>';
    }
}
