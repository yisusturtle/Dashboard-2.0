<?php
include("./dbconexion.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
#Crear tablas

#tabla de roles
$tablarol="CREATE TABLE ROL(
    rol_name VARCHAR(100),
    rol_id INT(3),
    descricion VARCHAR(100),
    CONSTRAINT PK_rolid PRIMARY KEY (rol_id)
);";

$creartablaRol=mysqli_query($conexion,$tablarol);

$insertRolUser="INSERT INTO ROL VALUES('usuario',1,'Usuario default sin privilegios')";
$returnInsert=mysqli_query($conexion,$insertRolUser);

$insertRolAdmin="INSERT INTO ROL VALUES('admin',2,'Usuario admin con privilegios')";
$returnInsert=mysqli_query($conexion,$insertRolAdmin);

#tabla de users
$tablausuario="CREATE TABLE users(
    email VARCHAR(100),
    contraseña VARCHAR(100) NOT NULL,
    fecha_creacion DATETIME NOT NULL,
    mod_passwd INT(2),
    fecha_mod DATETIME,
    ultima_conexion DATETIME,
    rol_id INT(2) DEFAULT 1,
    CONSTRAINT PK_email PRIMARY KEY (email),
    CONSTRAINT FK_rol FOREIGN KEY (rol_id) REFERENCES ROL(rol_id)
);";

$creartablaUsuario=mysqli_query($conexion,$tablausuario);

    #crear un usuario administrador por defecto
    $contraseñaAdmin=md5('me2021.');
$insertAdminUser="INSERT INTO users VALUES('admin@admin.com','$contraseñaAdmin',NOW(),NULL,NULL,NULL,2)";
$returnInsert=mysqli_query($conexion,$insertAdminUser);

#tabla de errores
$tablaError="CREATE TABLE ERRORS(
    id_error int NOT NULL AUTO_INCREMENT,
    error_descripcion VARCHAR(100),
    CONSTRAINT PK_iderror PRIMARY KEY (id_error)
);";

$creartablaError=mysqli_query($conexion,$tablaError);

#tabla logs error_logs
$tablaErrorLogs="CREATE TABLE ERROR_LOGS(
    id_error int NOT NULL AUTO_INCREMENT,
    email VARCHAR(100),
    fecha_error DATETIME,
    CONSTRAINT FK_iderror FOREIGN KEY (id_error) REFERENCES ERRORS(id_error),
    CONSTRAINT FK_email FOREIGN KEY (email) REFERENCES users(email)
);";

$creartablaError=mysqli_query($conexion,$tablaErrorLogs);


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
            #email
            $_SESSION['email']=$l_email;

            #ultima conexion
            $updateLastconection="UPDATE users SET ultima_conexion=NOW() WHERE email LIKE '$l_email';";
            $returnupdate=mysqli_query($conexion,$updateLastconection);
            $_SESSION['ultima_conexion']=$row['ultima_conexion'];

            #rol
            $selectrol="SELECT * FROM ROL, users WHERE email LIKE 'admin@admin.com' AND rol.rol_id=users.rol_id";
            $return_select_rol=mysqli_query($conexion,$selectrol);
            $row3=mysqli_fetch_array($return_select_rol, MYSQLI_ASSOC);
            $_SESSION['rol']=$row3['rol_name'];

            #numero de usuarios
            $selectcount="SELECT COUNT('email') FROM users";
            $returncount=mysqli_query($conexion,$selectcount);
            $row2=mysqli_fetch_array($returncount, MYSQLI_ASSOC);

            $_SESSION['count_users']=$row2["COUNT('email')"];

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
