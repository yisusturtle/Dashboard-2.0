<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
    
    $response = file_get_contents("https://192.168.1.30:6443/api/v1/pods", false, stream_context_create($arrContextOptions));
    echo $response;

    /* $url="https://192.168.1.30:6443/api/v1/pods"; //Ip con la VPN (cambiar en subida)
    file_get_contents($url); //funcion para hacer GET del contenido */
?>
