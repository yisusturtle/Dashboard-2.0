<?php
//#Cambiar valores al instalar bd
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db_name = "dashboard";
$host_name = "localhost";
$db_user = "project";
$db_passwd = 'me2021.'; 
$conexion = mysqli_connect($host_name, $db_user,$db_passwd, $db_name);
if(!$conexion)
{
    print("La conexion ha fallado: ". mysqli_errno($conexion));
}


?>
