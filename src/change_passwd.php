<?php
    if(isset($_POST['cambio-contra'])){ //Ver si se ha mandado una peticion a traves del formulario
        $email=$_POST['email'];
        $contraseña=password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost'=>12)); //encriptación de la contraseña

        include('../src/dbconexion.php');
        $select="SELECT * FROM users WHERE email LIKE '$email'"; 
        $return_select=mysqli_query($conexion,$select);
        $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);
        $modificaciones=$row['mod_passwd']+1;

        #generamos otra key de usuario
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $key = "";
        for($i=0;$i<10;$i++) {
        //obtenemos un caracter aleatorio escogido de la cadena de caracteres
        $key .= substr($str,rand(0,62),1);
        }
        $key_user=md5($key);

        //UPDATE DE LA CONTRASEÑA, NUMERO DE MODIFICACION Y
        $update1="UPDATE users SET contraseña='$contraseña', fecha_mod=NOW(), mod_passwd=$modificaciones, key_user='$key_user' WHERE email LIKE '$email'";

        $return_update=mysqli_query($conexion,$update1);

            //mail de confirmación CAMBIO DE CONTRASEÑA
            $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "$email";
            $subject = "Confirmación de cambio de contraseña";
            $message = '
            <html>
            <head>
            <title>Confirmacion de contraseña</title>
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
                                <h2 style="color: #17c200; margin: 0 0 7px">Se ha cambiado la contraseña!</h2>
                                <p style="margin: 2px; font-size: 15px">
                                    El cambio de contraseña ha concluido correctamente, ahora puedes navegar por nuestra pagina libremente, explorar los servicios y solicitar diferentes apps.</p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                                </div>
                                <div style="width: 100%; text-align: center">
                                    <a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #000000" href="https://dashboard.jmruiz.net">Ir a la pagina</a>	
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

            //REENVIO AL LOGIN
            header( "refresh:0.1 ; url=../pages/login-register.html" );
            print("<script>alert('La contraseña se ha cambiado correctamente.');</script>');</script>");
    }
?>