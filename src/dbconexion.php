<?php
#Cambiar valores al instalar bd
$db_name="dashboard";
$host_name="localhost";
$db_user="jesus";
$db_passwd="jesus";

$conexion=mysqli_connect($host_name,$db_user,$db_passwd,$db_name);

if(!$conexion){
    print("La conexion ha fallado: ". mysqli_errno($conexion));
};
?>