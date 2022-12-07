<?php
$hal = @$_GET['hal'];
$modul = "";
$default = $modul."beranda.php";

if(!$hal){
    require_once "$default";
}else{
    switch($hal){
        case $hal:
        if(is_file($modul.$hal.".php"))
        {
            require_once $modul.$hal.".php";
        }
        else
        {
            require_once "$default";
        }
        break;
        default:
            require_once "$default";
    }
}
?>  