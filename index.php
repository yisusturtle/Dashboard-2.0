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
    <link rel="icon" type="image/png" href="src/img/logo.png" > <!--FAVICON-->
    <link rel="stylesheet" href="css/style.css"> <!--ESTILOS NAVBAR Y LANDING PAGE 1-->
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
    <!--1º LANDING PAGE-->
    <div class="container1">
        <div class="sub-container">
            <!--NAVBAR-->
            <div class="navbar">
            <div class="navbar-open">
                <div class="open-menu" id="open-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <div class="menu-container">
                <div class="close-menu" id="close-menu"><i class="fas fa-times"></i></div>
                <div class="menu-links">
                    <div class="link ">
                        <a href="#" class="menu-link" id="link-icono">Inicio <i class="fas fa-house-damage iconos-link" id="iconos"></i></a>
                    </div>
                    <div class="link">
                        <a href="#pods" class="menu-link">Pods <i class="fab fa-docker iconos-link" id="iconos"></i></a>
                    </div>
                    <div class="link">
                        <a href="#services" class="menu-link">Services <i class="fas fa-server iconos-link" id="iconos"></i></a>
                    </div>
                    <div class="login">
                        <div class="usuario">
                            <i class="fas fa-user-circle"></i>
                            <span><?php print($_SESSION['email']);?></span>
                        </div>
                        <div class="salir">
                            <i class="fas fa-sign-out-alt"></i>
                            
                                <button type="submit" onclick="location.href='src/logout.php'" name="logout">Salir</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="navbar-scroll"></div>
            <!---->
            <!--STATIC LOGO-->
            <div class="logo-top">
                <div class="logo">
                    <img src="src/img/logo-banner.png" width="130px">
                </div>
            </div>
            <!---->
            <!--CONTENIDO LANDING PAGE 1-->
            <div class="resumen-projecto">
                <div class="resumen-texto">
                    <div class="text">
                        <h1 class="sobrenombre">TFG JN Y JMR</h1>
                        <p class="p-line">Lo que se quiere conseguir con este proyecto es que los
                            servidores tengan un sistema que haga que cuando haya mucho
                            tráfico en ellos se auto gestionen y ese tráfico se reenvíen a otros
                            servidores generados como clones para que no se caiga y esté en
                            constante funcionamiento.<br><br>
                            Esta página recopila los datos de los pods y servicios, haciendo asi mas accesible para el usuario la vista de ellos.
                        </p>
                        <div class="botones">
                            <div class="botones-link">
                                <a href="#" class="a-link"><i class="fab fa-github"></i> Repositorio</a>
                            </div>
                            <div class="botones-link">
                                <a href="#" class="a-link"><i class="far fa-file-word"></i> Documento</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ball" class="imagen-bola"></div>
            </div>
            <!---->
            <!--Wave absolutes-->
            <div class="wave">
                <img src="src/img/wave.svg" alt="" srcset="">
                <img src="src/img/wave2.svg" alt="" srcset="">
            </div>
        <!---->
        </div>
        <!---->
        
    </div>
    <!--FIN LANDING PAGE-->

    <!--2º LANDING PAGE (pods y servicios)-->
    <div class="container2">
        <div class="subcontainer2">
            <div class="pods pods-scroll" id="js-tablapods">
                <div class="pods-titulo pods-titulos-scroll" id="pods">
                    <h1 >PODS</h1>
                </div>
                <div class="pods-tabla">
                    <table id="tablaPods">
                        <thead class="thead">
                            <tr>
                                <th>POD Ip</th>
                                <th>Nombre</th>
                                <th>Namespace</th>
                                <th>UID</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="#tabla1" class="tbody tbody">
                            <!--CON JS SE RELLENAN CON EL JSON DEL SERVER-->
                        </tbody>                                     
                    </table>
                </div>
            </div>
            <div class="services servicios-scroll" id="js-tablaservicios">
                <div class="pods-titulo pods-titulos-scroll" id="services">
                    <h1 >SERVICIOS</h1>
                </div>
                <div class="pods-tabla">
                    <table id="tablaServices">
                        <thead class="thead">
                            <tr>
                                <th>ClusterIP</th>
                                <th>Nombre</th>
                                <th>Namespace</th>
                                <th>UID</th>
                            </tr>
                        </thead>
                        <tbody id="#tabla2" class="tbody tbody-scroll">
                            <!--CON JS SE RELLENAN CON EL JSON DEL SERVER-->
                        </tbody>
                    </table>             
                    </table>
                </div>
            </div>
            <div class="change-section change-section-scroll">
                <p>Al darle a "Servicios o Pods" cambias las tablas</p>
                <div class="change-table">
                    <i class="fas fa-server"></i>
                    <button id="cambiar-servicios">SERVICIOS</button>
                    <i class="fas fa-box-open"></i>
                    <button id="cambiar-pods">PODS</button>
                </div>
            </div>
        </div>
        
    </div>
    <!--FIN LANDING PAGE-->

    <!--FOOTER-->
    <div class="container3">
        <div class="subcontainer3">
            <img class="imagen-wave" src="src/img/wave5.svg" >
            <div class="footer-line">
                <div class="contenido-descripcion">
                    <div class="jesus-jose">
                        <div class="imagen-foto">
                            <img src="src/img/jesus.png" alt="" width="200px">
                        </div>
                        <div class="descripcion">
                            <h1>Jesus Narbona Aguilar</h1>
                            <h5>Programador y Diseñador Web</h5>
                            <p>Me dedico a la parte de la programación web,
                                detención de carga y programación en general.
                            </p>
                            <div class="email-descrip">
                                <i class="fas fa-envelope"></i><p>jesusnarbona2001@gmail.com</p>
                            </div>
                            <div class="enlaces-iconos">
                                <a href=""><i class="fab fa-github"></i></a>
                                <a href=""><i class="fas fa-file-word"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="jesus-jose jose">
                        <div class="imagen-foto">
                            <img src="src/img/jose.png" alt="" width="200px">
                        </div>
                        <div class="descripcion">
                            <h1>Jose Manuel Ruiz</h1>
                            <h5>Administrador de sistemas y servicios</h5>
                            <p>Gestion de todo lo
                                relacionado con el servidor, preparar servicios,
                                seguridad, y la red.
                            </p>
                            <div class="email-descrip">
                                <i class="fas fa-envelope"></i><p>jmruizortiz92@gmail.com</p>
                            </div>
                            <div class="enlaces-iconos">
                                <a href=""><i class="fab fa-github"></i></a>
                                <a href=""><i class="fas fa-file-word"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <span>©Copyright 2021</span>
            </div>
        </div>
        
    </div>
    <!---->
    <!--JS PRINCIPAL (FUNCIONALIDADES DE LA PAGINA)-->
    <script src="js/main.js"></script>
    <!---->
    <!--JS DE LA BOLA INTERACTIVA-->
    <script src="js/jquery_ball_interactive.js"></script>
    <!---->
</body>
</html>