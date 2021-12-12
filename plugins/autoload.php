<?php
$PLUGINS = scandir(__DIR__);
$i=2;
while($PLUGINS[$i] != ""){
    if($PLUGINS[$i] != "autoload.php"){
        $PLUGIN_DATA = json_decode(file_get_contents($PLUGINS[$i].'/infomation.json'),true)[0];
        include($PLUGINS[$i].'/'.$PLUGIN_DATA[0]['loader']);
        $i++;
    }
}