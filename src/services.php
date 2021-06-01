<?php
    session_start();
    if($_SESSION['rol']!="admin"){ //Comprobar si hay una session con rol de administrador
        header("Location: ./login-register.html");
        exit;
    };
    //Peticion GET a la API

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  

    $response = file_get_contents("https://192.168.1.30:6443/api/v1/pods/", false, stream_context_create($arrContextOptions));
    echo $response;//JSON para manejar en js
?>
