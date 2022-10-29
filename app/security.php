<?php
class security {

    const INPUT_ENC_METHOD = "AES-256-CBC";
    const KEY_ENC_METHOD = "SHA256";

    private $app_key;    
    private $iv;

    public function __construct(){
        $config = parse_ini_file(dirname(__DIR__, 1).'/config.ini');
        $this->app_key = hash( self::KEY_ENC_METHOD, $config['KEY_ONE']);
        $this->iv = substr(hash(self::KEY_ENC_METHOD, $config['KEY_TWO']),0,16);
    }

    /**
    * @param string|int $input - String to be encrypted
    * 
    * @return string 
    *
    */
    public function encrypt($input){
        return base64_encode(openssl_encrypt($input, self::INPUT_ENC_METHOD, $this->app_key, 0, $this->iv));
    }
    
    /**
    * @param string $encrypted_input - Encrypted string to be decrypted
    * 
    * @return string|bool returns false if $encrypted_input isn't an encrypted string. 
    *
    */
    public function decrypt($input){
        return openssl_decrypt(base64_decode($input), self::INPUT_ENC_METHOD, $this->app_key, 0, $this->iv);
    }

    public function randomString($length = 3) {
    $randomString = '';
    $characters = implode("", array_merge(range('a', 'z'), range('A', 'Z')));
    for ($i = 0; $i < $length; $i++) $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
    return $randomString;
    }
    public function encode($output) { 
        $randomFunc = $this->randomString();
        $randomOut = $this->randomString();
        $randomNum = $this->randomString();
        $randomVal = mt_rand(999999, 99999999);
        $return = '
        <!-- HTML Source Code Protection by Mafuth -->
    <script>
    var ' . $randomOut . ' = ""; var ' . $randomNum . ' = [';
        foreach(str_split($output) as $x){ $return .= '"'.base64_encode($this->randomString().(ord($x) + $randomVal).$this->randomString()) . '", '; if (mt_rand(0, 1)){ $return .= "\n"; } }
        $return = rtrim($return, ', ');
        $return .= ']; ' . $randomNum . '.forEach(function ' . $randomFunc . '(value) { ' . $randomOut . ' += String.fromCharCode(parseInt(atob(value).replace(/\D/g,\'\')) - ' . $randomVal . '); } ); document.write(decodeURIComponent(escape(' . $randomOut . '))); </script>'  ;;
        
        return $return;
    }
    public function inspect_bloker(){
        $CODE ="
        <script>
        const _0x3049=['AhrTBa','B3jPzw50yxrPB24','mtGWnwHnq0nzzG','mvjytNjjzq','vgHLignVzguGzM9YihrOAxmGD2vIC2L0zsbOyxmGC2vSzIbKzxn0CNvJDgvKigLUihLVDxiGyNjVD3nLCIbMB3iGChjVDgvJDgLVBIbMCM9TigHHy2TLCNmGyMfJyxvZzsb5B3uGB3bLBMvKihrOzsbJB25ZB2XLlIbiyxzLigeGBMLJzsbKyxKGoKq','Bg9N','DMvYDgLJywW','nZa1mZKXCM5yyvrg','y2HYB21L','B3v0zxjizwLNAhq','B3v0zxjxAwr0Aa','zgv0ywLS','zgv2Dg9VBhnJAgfUz2u','otCXndCYwNfyA1fc','otu1mdi0CwzJyLvc','zxHWB3j0CW','zgLZCgf0y2HfDMvUDa','mtm1nvDltgP6ua','Aw5UzxjizwLNAhq','nJqZnda3C0vLtvPz','mvros3zTCG','Aw5UzxjxAwr0Aa','Dw5KzwzPBMvK','x3nLBgy','AxnpCgvU','ywrKrxzLBNrmAxn0zw5LCG','mZeZA2jHCw5x','z2v0rwXLBwvUDhncEvrHz05HBwu','mJi5otG3CgzRBeDY','BgvUz3rO','B3bLBG','ndm5zuHAt01K','rMLYzwj1zW','Ag9YAxPVBNrHBa','CMvTB3zL','mxb2quTVsG','l29MzMXPBMu'];(function(_0x275254,_0x55a077){const _0x25134b=_0x410f;while(!![]){try{const _0x203feb=parseInt(_0x25134b(0xe2))*parseInt(_0x25134b(0xea))+parseInt(_0x25134b(0xf6))*-parseInt(_0x25134b(0xfa))+-parseInt(_0x25134b(0x100))+-parseInt(_0x25134b(0xe1))*-parseInt(_0x25134b(0xf1))+parseInt(_0x25134b(0xe8))*-parseInt(_0x25134b(0x104))+parseInt(_0x25134b(0x101))+-parseInt(_0x25134b(0xf5))*-parseInt(_0x25134b(0xed));if(_0x203feb===_0x55a077)break;else _0x275254['push'](_0x275254['shift']());}catch(_0x286163){_0x275254['push'](_0x275254['shift']());}}}(_0x3049,0x7ee9b));;function _0x410f(_0x12a7b3,_0x4c195a){_0x12a7b3=_0x12a7b3-0xe1;let _0x304948=_0x3049[_0x12a7b3];if(_0x410f['haugbU']===undefined){var _0x410f6b=function(_0x35d3e8){const _0x2cccc2='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';let _0x373955='';for(let _0x5c050b=0x0,_0x52353d,_0x3e4497,_0x1c941a=0x0;_0x3e4497=_0x35d3e8['charAt'](_0x1c941a++);~_0x3e4497&&(_0x52353d=_0x5c050b%0x4?_0x52353d*0x40+_0x3e4497:_0x3e4497,_0x5c050b++%0x4)?_0x373955+=String['fromCharCode'](0xff&_0x52353d>>(-0x2*_0x5c050b&0x6)):0x0){_0x3e4497=_0x2cccc2['indexOf'](_0x3e4497);}return _0x373955;};_0x410f['SqKHVg']=function(_0x3bd1cb){const _0x3764f7=_0x410f6b(_0x3bd1cb);let _0x11e07b=[];for(let _0x2c7e10=0x0,_0x3a3c50=_0x3764f7['length'];_0x2c7e10<_0x3a3c50;_0x2c7e10++){_0x11e07b+='%'+('00'+_0x3764f7['charCodeAt'](_0x2c7e10)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x11e07b);},_0x410f['sEOZVh']={},_0x410f['haugbU']=!![];}const _0x476714=_0x3049[0x0],_0x447c1f=_0x12a7b3+_0x476714,_0x2c822f=_0x410f['sEOZVh'][_0x447c1f];return _0x2c822f===undefined?(_0x304948=_0x410f['SqKHVg'](_0x304948),_0x410f['sEOZVh'][_0x447c1f]=_0x304948):_0x304948=_0x2c822f,_0x304948;}(function(){'use strict';const _0x2fc73a=_0x410f;const _0x476714={'isOpen':![],'orientation':undefined},_0x447c1f=0xa0,_0x2c822f=(_0x2cccc2,_0x373955)=>{const _0x44c1ef=_0x410f;window[_0x44c1ef(0x103)](new CustomEvent(_0x44c1ef(0xff),{'detail':{'isOpen':_0x2cccc2,'orientation':_0x373955}}));},_0x35d3e8=({emitEvents:emitEvents=!![]}={})=>{const _0x5ceaff=_0x410f,_0x5c050b=window[_0x5ceaff(0xfd)]-window[_0x5ceaff(0xe3)]>_0x447c1f,_0x52353d=window[_0x5ceaff(0xfc)]-window[_0x5ceaff(0x105)]>_0x447c1f,_0x3e4497=_0x5c050b?_0x5ceaff(0xf9):_0x5ceaff(0xef);!(_0x52353d&&_0x5c050b)&&(window[_0x5ceaff(0xee)]&&window['Firebug']['chrome']&&window[_0x5ceaff(0xee)][_0x5ceaff(0xfb)]['isInitialized']||_0x5c050b||_0x52353d)?((!_0x476714[_0x5ceaff(0xe6)]||_0x476714['orientation']!==_0x3e4497)&&emitEvents&&_0x2c822f(!![],_0x3e4497),_0x476714[_0x5ceaff(0xe6)]=!![],_0x476714[_0x5ceaff(0xf4)]=_0x3e4497):(_0x476714[_0x5ceaff(0xe6)]&&emitEvents&&_0x2c822f(![],undefined),_0x476714['isOpen']=![],_0x476714[_0x5ceaff(0xf4)]=undefined);};_0x35d3e8({'emitEvents':![]}),setInterval(_0x35d3e8,0x1f4),typeof module!==_0x2fc73a(0xe4)&&module[_0x2fc73a(0x102)]?module[_0x2fc73a(0x102)]=_0x476714:window['devtools']=_0x476714;}());;(function(){const _0x50c4ea=_0x410f;function _0x1c941a(){const _0x2d6b25=_0x410f;console[_0x2d6b25(0xf8)](_0x2d6b25(0xf7)),console[_0x2d6b25(0xf8)]('Please\x20close\x20the\x20console,\x20and\x20go\x20back\x20to\x20the\x20previous\x20page.'),window[_0x2d6b25(0xec)](_0x2d6b25(0xf2),_0x2d6b25(0xe5));let _0x3bd1cb=document[_0x2d6b25(0xe9)](_0x2d6b25(0xf3));for(let _0x3764f7=0x0;_0x3764f7<_0x3bd1cb[_0x2d6b25(0xeb)];_0x3764f7++){_0x3bd1cb[_0x2d6b25(0xf0)]();}}window['devtools'][_0x50c4ea(0xe6)]&&_0x1c941a(),window[_0x50c4ea(0xe7)]('devtoolschange',_0x11e07b=>{const _0x448d87=_0x50c4ea;_0x11e07b[_0x448d87(0xfe)][_0x448d87(0xe6)]&&_0x1c941a();});}());
        </script>";
        return $CODE;
    }
    
}