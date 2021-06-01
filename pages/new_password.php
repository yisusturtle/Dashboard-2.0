<?php
    if(!isset($_GET['key_user']) || !isset($_GET['email'])){ //Comprobar si en la URL hay parametros GET de email y key_user
        header('location:./login-register.html');
        exit;
        
    }
        include('../src/dbconexion.php');
        $email_recover=$_GET['email'];
        $key_user=$_GET['key_user'];
        $select="SELECT * FROM users WHERE email LIKE '$email_recover'";
        $return_select=mysqli_query($conexion,$select);
        $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC);  

        if($row['key_user']<>$key_user){   //Comprobar si el key_user de la URL coincide con el del usuario de la base de datos
            header('location:./login-register.html');
            exit;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../src/img/logo.png" > <!--FAVICON-->
    <link rel="stylesheet" href="../css/login-register.css">
    <title>Dashboard</title>

    <style>
        .register-form{
            display: flex !important;
        }
    </style>

    <!--ICONOS FONTAWESOME-->
    <script src="https://kit.fontawesome.com/755a2f5b9f.js" crossorigin="anonymous"></script>
    <!---->

    <script src="../js/validate_form.js"></script>
</head>
<body>
    <!--GSAP (para animaciondes)-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <!---->
    
    <div class="container">
        <div class="subcontainer">
            <!--Login-Register-Recovery-->
            <div class="cont-form">
                <div class="login">
                    <div class="logo" id="logo-estatico">
                        <img src="../src/img/logo-banner.png" width="200px">
                    </div>
                    <div class="formulario register-form" id="register">
                        <h1 id="form-titulo">RECOVERY</h1>                        
                        <form method="post" onsubmit="return validarPasswd()" action="../src/change_passwd.php">
                            <div class="inputs">
                                <input type="hidden" name="email"  placeholder="Email" value="<?php echo("$email_recover");?>">
                            </div>
                            <div class="inputs">
                                <i class="fas fa-unlock-alt"></i>
                                <input type="password" placeholder="Nueva contraseña" name="password" id="contraseña_1">
                            </div>
                            <div class="inputs">
                                <i class="fas fa-key"></i>
                                <input type="password" placeholder="Repita la contraseña" name="password2" id="contraseña_2">
                            </div>
                            <div id="error">a</div>
                            <div class="inputs">
                                <input type="submit" value="Cambiar" name="cambio-contra" id="">
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
            <div class="cont-img">
                <div class="imagen-logo">
                    <div class="circulo"></div>
                    <img src="../src/img/logo.png" width="200px">
                </div>
            </div>
        </div>
    </div>
    <script src="../js/l_g.js"></script>
</body>
</html>