<?php
include("./dbconexion.php");

#Crear tablas
$tablausuario="CREATE TABLE users(
    email VARCHAR(100),
    contraseña VARCHAR(100) NOT NULL,
    fecha_creacion DATETIME NOT NULL,
    mod_passwd INT(2),
    fecha_mod DATETIME,

    CONSTRAINT PK_email PRIMARY KEY (email)
);";

$creartabla=mysqli_query($conexion,$tablausuario);

#REGISTRO
if(isset($_POST['enviar-registrar'])){
    $r_email=$_POST['email'];
    $r_passwd=md5($_POST['password']); //md5 es para cifrar las contraseñas

    $select_email="SELECT email FROM users WHERE email LIKE '$r_email'";
    $return_select=mysqli_query($conexion,$select_email);

    $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);
    if(empty($row['email'])){
        $insert_user="INSERT INTO users (email,contraseña,fecha_creacion) VALUES('$r_email','$r_passwd',NOW())";
        $return_insert=mysqli_query($conexion,$insert_user);

        if($return_insert){
            header( "refresh:0.1 ; url=../pages/login-register.html" );
            print("<script>alert('Se ha registrado correctamente, en 2 segundos se redigira al LOGIN');</script>");
        }
    }
    else{
        print("<script>alert('Ha ocurrido un error, el email introducido ya esta cogido');</script>");
        header( "refresh:1 ; url=../pages/login-register.html" );
    }
}

#LOGIN
if(isset($_POST['enviar-login'])){
    $l_email=$_POST['email'];
    $l_passwd=md5($_POST['password']);

    $select_email="SELECT * FROM users WHERE email LIKE '$l_email'";
    $return_select=mysqli_query($conexion,$select_email);
    $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);

    if(!empty($row['email'])){
        $db_contraseña=($row['contraseña']);
        if($l_passwd == $db_contraseña){
            session_start();
            $_SESSION['email']=$l_email;
            header('Location: ../index.php');
        }
        else{
            print("<script>alert('Ha ocurrido un error, la contraseña es incorrecta, intentalo de nuevo');</script>");
            header( "refresh:1 ; url=../pages/login-register.html" );
        }
    }
    else{
        print("<script>alert('Ha ocurrido un error, el email introducido no existe, intentalo de nuevo');</script>");
        header( "refresh:1 ; url=../pages/login-register.html" );
    }
}
