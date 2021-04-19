<?php
    session_start();
    if(empty($_SESSION['email'])){
        header("Location: pages/login-register.html");
        exit;
    };  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../src/img/logo.png" > <!--FAVICON-->
    <link rel="stylesheet" href="../css/dashboard.css"> <!--ESTILOS NAVBAR Y LANDING PAGE 1-->
    <title>Dashboard</title>

    <!--ICONOS FONTAWESOME-->
    <script src="https://kit.fontawesome.com/755a2f5b9f.js" crossorigin="anonymous"></script>
    <!---->
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!---->
    <!--GSAP-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>
    <!---->

</head>
<body>
    <div class="container">
        <nav>
                <div class="enlaces-content active" id="s1"><i class="fas fa-book"></i>INTRODUCCION</div>
                <div class="enlaces-content active" id="s2"><i class="fas fa-plus"></i>DEPLOYS</div>
                <div class="enlaces-content active" id="s3"><i class="fas fa-box-open"></i>MIS SERVICIOS</div>
                <div class="enlaces-content active" id="s4"><i class="fas fa-link"></i>CONEXIONES</div>
                <div class="enlaces-content active" id="s5"><i class="fas fa-question-circle"></i>AYUDA</div>
        </nav>

        <div class="header-nav">
            <div class="logo">
                <img src="../src/img/logo-banner.png" alt="" srcset="" width="200px">
            </div>
            <div class="header-info"><i class="fas fa-users"></i>USERS: [<span><?php echo($_SESSION['count_users'])?></span>]</div>
            <div class="header-info"><i class="fas fa-clock"></i>LAST CONNECTION: [<span><?php echo($_SESSION['ultima_conexion'])?></span>]</div>
            <div class="header-info"><i class="fas fa-key"></i>ROLE: [<span><?php echo($_SESSION['rol'])?></span>]</div>
            <div class="header-info">
                <i class="fas fa-user"></i>USER:
                [<span><?php echo($_SESSION['email'])?></span>]
            </div>
                <div class="header-info">TIME: [<span id="reloj">00:00:00</span>]</div>
        </div>
        
        <div class="container-sections">
            <div class="section" id="section1">
                <h1>INTRO</h1>
            </div>
            <div class="section" id="section2">
                <div class="titulo">
                    <i class="fas fa-plus"></i> <span>NUEVO DEPLOY</span>
                </div>
                <p>Selecciona el tipo de deploy:</p>
                <div class="deploy">
                    <form action="" method="POST">
                        <div class="wordpress">
                            <i class="fab fa-wordpress"></i>
                            <span>WORDPRESS</span>
                        </div>
                        <input type="checkbox" name="wordpress" value="wordpress" required>
                        <div class="text-inputs">
                            <span>Nombre de la base de datos:</span>
                            <input type="text" name="db_name" id="" placeholder="Ej: nombreusuario-15-04-2021" required>
                        </div>
                        <div class="text-inputs">
                            <span>Contraseña de la base de datos:</span>
                            <input type="password" name="db_passwd" id="" placeholder="Crea una contraseña segura" required>
                        </div>
                        <div class="text-inputs">
                            <span>Contraseña del wordpress:</span>
                            <input type="text" name="passwd_wordpress" id="" placeholder="Crea una contraseña segura" required>
                        </div>
                        
                        <input type="submit" class="envio" value="CREAR">
                    </form>
                </div>
            </div>
            <div class="section" id="section3">
                <h1>MIS SERVICIOS</h1>
            </div>
            <div class="section" id="section4">
                <h1>CONEXIONES</h1>
            </div>
            <div class="section" id="section5">
                <h1>AYUDA</h1>
            </div>
        </div>
    </div>
    
    <script src="../js/dashboard.js"></script>
    <script>
        //reloj
        function actual(){
            fecha=new Date();
            hora=fecha.getHours();
            minutos=fecha.getMinutes();
            segundos=fecha.getSeconds();

            if(hora<10){
                hora="0"+hora;
            }
            if(minutos<10){
                minutos="0"+minutos;
            }
            if(segundos<10){
                segundos="0"+segundos;
            }

            mireloj=hora +":"+minutos+":"+segundos;
            return mireloj;
        }

        function actualizar(){
            mihora=actual();
            mireloj=document.getElementById("reloj");
            mireloj.innerHTML=mihora;
        }

        setInterval(actualizar,1000);
    </script>
</body>
</html>