<?php
#Crear tablas en la BD

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
    mod_passwd INT(2) DEFAULT 0,
    fecha_mod DATETIME,
    ultima_conexion DATETIME,
    rol_id INT(2) DEFAULT 1,
    key_user VARCHAR(100),
    CONSTRAINT PK_email PRIMARY KEY (email),
    CONSTRAINT FK_rol FOREIGN KEY (rol_id) REFERENCES ROL(rol_id)
);";

$creartablaUsuario=mysqli_query($conexion,$tablausuario);

//------
    #key para recuperación
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $key = "";
    for($i=0;$i<10;$i++) {
    //obtenemos un caracter aleatorio escogido de la cadena de caracteres
    $key .= substr($str,rand(0,62),1);
    }
    $key_user=md5($key);

    #crear un usuario administrador por defecto
    $contraseñaAdmin=password_hash('me2021.', PASSWORD_BCRYPT, array('cost'=>12));
    $insertAdminUser="INSERT INTO users VALUES('admin@admin.com','$contraseñaAdmin',NOW(),0,NULL,NULL,2,'$key_user')";
    $returnInsert=mysqli_query($conexion,$insertAdminUser);

//------

#tabla de errores
$tablaError="CREATE TABLE ERRORS(
    id_error int NOT NULL AUTO_INCREMENT,
    error_descripcion VARCHAR(100),
    CONSTRAINT PK_iderror PRIMARY KEY (id_error)
);";

$creartablaError=mysqli_query($conexion,$tablaError);

#tabla logs error_logs
$tablaErrorLogs="CREATE TABLE ERROR_LOGS(
    id_error int AUTO_INCREMENT,
    email VARCHAR(100),
    fecha_error DATETIME,
    CONSTRAINT PK_email PRIMARY KEY (email, id_error),
    CONSTRAINT FK_iderror FOREIGN KEY (id_error) REFERENCES ERRORS(),
    CONSTRAINT FK_email FOREIGN KEY (email) REFERENCES users(email)
);";

$creartablaError=mysqli_query($conexion,$tablaErrorLogs);

#tabla deployements
$tablaDeploy="CREATE TABLE DEPLOYEMENT(
    nombre_deploy VARCHAR(100),
    fecha_deploy DATETIME,
    email VARCHAR(100),
    CONSTRAINT PK_nombre PRIMARY KEY (nombre_deploy),
    CONSTRAINT FK_emailU FOREIGN KEY (email) REFERENCES users(email)
);";
$creartablaDeploy=mysqli_query($conexion,$tablaDeploy);

#REGISTRO
if(isset($_POST['enviar-registrar'])){
    $r_email=$_POST['email'];
    $r_passwd=password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost'=>12));
    /* $r_passwd=md5($_POST['password']); //md5 es para cifrar las contraseñas */

    $select_email="SELECT email FROM users WHERE email LIKE '$r_email'";
    $return_select=mysqli_query($conexion,$select_email);

    $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);

    if(empty($row['email'])){ //Comprobacion de si existe el email
        $insert_user="INSERT INTO users (email,contraseña,fecha_creacion,key_user) VALUES('$r_email','$r_passwd',NOW(),'$key_user')";
        $return_insert=mysqli_query($conexion,$insert_user);

        if($return_insert){//Envio de confirmacion de registro por mail
            $username=substr($r_email, 0, strpos($r_email, '@'));
            $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "$r_email";
            $subject = "Confirmación de registro";
            $message = '
            <html>
            <head>
            <title>Confirmacion de registro</title>
            </head>
            <body>
            <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
                    <tr>
                        <td style="text-align: left; padding: 0">
                            <a href="https://dashboard.jmruiz.net">
                                <img width="100%" style="display:block; margin-bottom: 5px;" src="https://i.postimg.cc/W1pT8b3s/email.png">
                            </a>
                        </td>
                    </tr>
                    <tr >
                        <td style="border: solid #ecf0f1 2px;" >
                            <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                                <h2 style="color: #17c200; margin: 0 0 7px">Hola '. $username.'!</h2>
                                <p style="margin: 2px; font-size: 15px">
                                    Bienvenido a nuestra web, esta web es un proyecto experimental en la trabajamos lo mejor posible por
                                    llegar al objetivo establecido.
                                Hay que mencionar que todo esta argumentado en distintos documentos que forman parte de este proyecto.</p>
                                <ul style="font-size: 15px; list-style:square;  margin: 10px 0">
                                    <li>Respositorio del proyecto: <a href="https://github.com/yisusturtle/Dashboard-2.0">DashboardProject</a></li>
                                    <li>Sysadmin: jmruiz@gmail.com</li>
                                    <li>Programador: jesusnarbona2001@gmail.com</li>
                                </ul>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                                </div>
                                <div style="width: 100%; text-align: center">
                                    <a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #000000" href="https://dashboard.jmruiz.net/pages/login-register.html">Ir a la página</a>	
                                </div>
                                <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">©Dashboardjmruiz.net 2021</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';
            $headers = "From:" . $from. "\r\n";
            $headers  .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1';

            // Envio de email
            mail($to, $subject, $message, $headers);
                        header( "refresh:0.1 ; url=../pages/login-register.html" );
                        print("<script>alert('Se ha registrado correctamente, en 2 segundos se redigira al LOGIN');</script>");
        }
        else{
            print("<script>alert('Ha ocurrido un error');</script>");
            header( "refresh:1 ; url=../pages/login-register.html" );
        }
        
    else{
        print("<script>alert('Ha ocurrido un error, el email introducido ya esta cogido');</script>");
        header( "refresh:1 ; url=../pages/login-register.html" );
    }
            

#LOGIN
if(isset($_POST['enviar-login'])){
    $l_email=$_POST['email'];
    $l_passwd=$_POST['password'];

    $select_email="SELECT * FROM users WHERE email LIKE '$l_email'";
    $return_select=mysqli_query($conexion,$select_email);
    $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);

    if(!empty($row['email'])){//Comprobacion de si existe en la base datos
        $db_contraseña=($row['contraseña']);
        if(password_verify($l_passwd,$db_contraseña)){ //Comprobacion de la contraseña
            session_start();
            #email
            $_SESSION['email']=$l_email;

            #ultima conexion
            $updateLastconection="UPDATE users SET ultima_conexion=NOW() WHERE email LIKE '$l_email';";
            $returnupdate=mysqli_query($conexion,$updateLastconection);
            $_SESSION['ultima_conexion']=$row['ultima_conexion'];

            #rol
            $selectrol="SELECT * FROM ROL, users WHERE email LIKE '$l_email' AND ROL.rol_id=users.rol_id";
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

#RECOVER PASSWD
if(isset($_POST['recover-passwd'])){
    $email=$_POST['email'];

    $select_email="SELECT * from users WHERE email LIKE '$email'";

    $return_select=mysqli_query($conexion,$select_email);

    $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);

    if(!empty($row)){ //Comprobacion de si existe el email
            $email=$row['email'];
            $key_user=$row['key_user'];
            
            //Envio de correo para recuperacion de contraseña
            $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "$email";
            $subject = "Recuperación de contraseña";
            $message = '
            <html>
            <head>
            <title>Recuperacion de contraseña</title>
            </head>
            <body>
            <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
                    <tr>
                        <td style="text-align: left; padding: 0">
                            <a href="https://dashboard.jmruiz.net">
                                <img width="100%" style="display:block; margin-bottom: 5px;" src="https://i.postimg.cc/W1pT8b3s/email.png">
                            </a>
                        </td>
                    </tr>
                    <tr >
                        <td style="border: solid #ecf0f1 2px;" >
                            <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                                <h2 style="color: #17c200; margin: 0 0 7px">Has solicitado un cambio de contraseña !</h2>
                                <p style="margin: 2px; font-size: 15px">
                                    Has solicitado la recuperacion de la contraseña, para recuperar la contraseña pincha en el boton siguiente.</p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                                </div>
                                <div style="width: 100%; text-align: center">
                                    <a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #000000" href="https://dashboard.jmruiz.net/pages/new_password.php?email='.$email.'&key_user='.$key_user.'">Recuperar contraseña</a>	
                                </div>
                                <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">©Dashboardjmruiz.net 2021</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';
            $headers = "From:" . $from. "\r\n";
            $headers  .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1';
        mail($to,$subject,$message, $headers);
        print("<script>alert('Se te ha enviado un correo al mail aportado, sigue los pasos para poder cambiar tu contraseña.');</script>");
        header( "refresh:1 ; url=../pages/login-register.html" );
    }
    else{
        print("<script>alert('Ha ocurrido un error, el email introducido no existe, intentalo de nuevo');</script>");
        header( "refresh:1 ; url=../pages/login-register.html" );
    }

}
