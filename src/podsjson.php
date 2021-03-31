<?php
    $url="http://172.27.0.10:8081/api/v1/pods"; //Ip con la VPN (cambiar en subida)
    echo file_get_contents($url); //funcion para hacer GET del contenido
?>