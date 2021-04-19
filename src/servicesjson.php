<?php

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  

    $response = file_get_contents("https://192.168.1.30:6443/api/v1/services", false, stream_context_create($arrContextOptions));

    echo $response;

    /* $url="http://192.168.1.30:8002/api/v1/services"; //Ip con la VPN (cambiar en subida)
    echo file_get_contents($url); //funcion para hacer GET del contenido */
?>
