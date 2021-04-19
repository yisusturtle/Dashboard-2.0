<?php
//#Cambiar valores al instalar bd
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$db_name = "dashboard";
$host_name = "localhost";
$db_user = "root";
$db_passwd = '';
$conexion = mysqli_connect($host_name, $db_user,$db_passwd, $db_name);
if(!$conexion)
{
    print("La conexion ha fallado: ". mysqli_errno($conexion));
}

/* 
$db_name = "dashboard";
$host_name = "localhost";
$db_user = "project";
$db_passwd = 'me2021.'; 
*/

$selectrol="SELECT * FROM ROL, users WHERE email LIKE 'admin@admin.com' AND rol.rol_id=users.rol_id";
            $return_select_rol=mysqli_query($conexion,$selectrol);
            $row3=mysqli_fetch_array($return_select_rol, MYSQLI_ASSOC);
            $_SESSION['rol']=$row3['ultima_conexion'];
            print_r($_SESSION['rol'])
?>
