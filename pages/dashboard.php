<?php
    session_start();
    if(empty($_SESSION['email'])){ //Comprobar si el usuario ha iniciado sesion
        header("Location: ./login-register.html");
        exit;
    };
    
    //Recoger nombre y email para usar
    include('../src/dbconexion.php');
    $email=$_SESSION['email'];
    $emailsubstr=substr($email, 0, strpos($email, '@'));
    $select_email="SELECT * FROM DEPLOYEMENT WHERE email LIKE '$email'";
    $return_select=mysqli_query($conexion,$select_email);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../src/img/logo.png" > <!--FAVICON-->
    <link rel="stylesheet" href="../css/style-dashboard.css"> <!--ESTILOS NAVBAR Y LANDING PAGE 1-->
    <title>Dashboard</title>

    <!--ICONOS FONTAWESOME-->
    <script src="https://kit.fontawesome.com/755a2f5b9f.js" crossorigin="anonymous"></script>
    <!---->

</head>
<body>
    <div class="container">
        <nav>
                <div class="enlaces-content active" id="s1"><i class="fas fa-book"></i>INTRODUCCION</div>
                <div class="enlaces-content active" id="s2"><i class="fas fa-plus"></i>DEPLOYS</div>
                <div class="enlaces-content active" id="s3"><i class="fas fa-box-open"></i>MIS SERVICIOS</div>
                <div class="enlaces-content active" id="s4"><i class="fas fa-question-circle"></i>AYUDA</div>
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
            <!-- INTRODUCCION -->
            <div class="section" id="section1">
                <div class="titulo">
                    <i class="fas fa-book"></i><h4>INTRODUCCION</h4>
                </div>
                <div class="description-intro">
                    <div class="texto-intro">
                        <h1>¿Cual es el funcionamiento?</h1>
                        <p>Kubernetes más conocido como k8s, es un Orquestador de Docker, lo cual quiere decir que desde Kubernetes podremos gestionar nuestros contenedores y realizar diferentes tareas con respecto a estos contenedores.            </p>
                        <br>
                        <p>Nosotros mediante la API propia de Kubernetes hemos conseguido desplegar contenedores atraves de la web, puedes probarlo de la siguiente forma:</p>
                        <br>
                        <ul>
                            <li>Entra en el apartado de DEPLOYS</li>
                            <li>Selecciona el nombre del wordpress que quieras crear</li>
                            <li>Vete a la sección de mis servicios, donde encontraras tu URL para acceder al wordpress</li>
                        </ul>
                       
                    </div>
                    <div class="imagen-presentacion">
                            <img src="../src/img/imgpresent.png" alt="" width="600px" style="border:solid black 2px;">
                    </div>
                </div>
            </div>
            <!-- DEPLOY -->
            <div class="section" id="section2">
                <div class="titulo">
                    <i class="fas fa-plus"></i> <h4>NUEVO DEPLOY</h4>
                </div>
                <p>Selecciona el tipo de deploy:</p>
                <div class="deploy">
                    <div class="logos">
                        <div class="wordpress selected" id="wordpress-btn">
                                <i  class="fab fa-wordpress"></i> <!-- wordpress -->
                                <span class="no-work">WORDPRESS</span> <!-- wordpress -->
                        </div>
                        <div class="nginx" id="nginx-btn">
                                <i class="fab fa-neos"></i> <!-- nginx -->
                                <span>NGINX</span> <!-- nginx -->
                        </div>
                        
                        <div class="apache" id="apache-btn">
                                <i class="fas fa-feather-alt"></i> <!-- apache -->
                                <span>APACHE</span> <!-- apache -->
                        </div>
                    </div>
                    <form method="POST" action="../API/deployment.php" id="wordpress">
                        
                        <div class="text-inputs">
                            <span>Nombre de la web:</span>
                            <input type="text" name="web_name" id="" placeholder="Ej: nombreusuario-15-04-2021" required>
                        </div>
                        <div class="text-inputs">
                            <span >Contraseña de la base de datos:</span> <!-- wordpress -->
                            <input type="password" name="db_passwd" id="" placeholder="Crea una contraseña segura"> <!-- wordpress -->
                        </div>
                        
                        <div class="enviar-datos">
                            <input type="submit" class="envio" name="enviar" value="CREAR">
                        </div>
                    </form>
                    <form method="POST" action="../API/deployment-apache.php" id="apache">
                        <div class="text-inputs">
                            <span>Nombre de la web:</span>
                            <input type="text" name="web_name" id="" placeholder="Ej: nombreusuario-15-04-2021" required>
                        </div>
                        
                        <div class="enviar-datos">
                            <input type="submit" class="envio" name="enviar" value="CREAR">
                        </div>
                    </form>
                    <form method="POST" action="../API/deployment-nginx.php" id="nginx">
                        
                        <div class="text-inputs">
                            <span>Nombre de la web:</span>
                            <input type="text" name="web_name" id="" placeholder="Ej: nombreusuario-15-04-2021" required>
                        </div>
                        <div class="enviar-datos">
                            <input type="submit" class="envio" name="enviar" value="CREAR">
                        </div>
                    </form>
                </div>
            </div>
            <!-- SERVICIOS -->
            <div class="section" id="section3">
                <div class="titulo">
                    <i class="fas fa-box-open"></i> <h4>MIS SERVICIOS</h4>
                </div>
                <div class="tablas">
                    <table>
                        <thead>
                            <tr>
                                <th>Web</th>
                                <th>fecha despliegue</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while( $row=mysqli_fetch_array($return_select, MYSQLI_ASSOC)){?>
                                    <tr>
                                        <td><a href="https://<?php echo($row['nombre_deploy'])?>.k8s.jmruiz.net:8443">https://<?php echo($row['nombre_deploy'])?>.k8s.jmruiz.net:8443</a></td>
                                        <td><?php echo($row['fecha_deploy'])?></td>
                                    </tr>
                                <?php
                                }
                            ?>
                        
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Imagen</th>                       
                            </tr>
                        </thead>
                        <tbody id="res">
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- AYUDA -->
            <div class="section" id="section4">
            <div class="titulo">
                <i class="fas fa-question-circle"></i> <h4>AYUDA</h4>
                </div>
                <p>¿Que tipo de soporte necesitas?</p>
                <div class="deploy">
                    <form method="POST" action="../src/soporte.php">
                            <select name="select">
                                <option value="op1" selected>Soporte tecnico</option>
                                <option value="op2">Soporte de atencion al cliente</option>
                                <option value="op3">Otro tipo de soporte</option>
                            </select>
                        <div class="text-inputs">
                            <span><i class="fas fa-at"></i> Email</span>
                            <input type="text" name="correo_soporte" placeholder="Tu correo" required>
                        </div>
                        <div class="text-inputs">
                            <span><i class="fas fa-question"></i> Asunto</span>
                            <input type="text" name="asunto_soporte" placeholder="Ej: 'No funciona el servicio...'" required>
                        </div>
                        <div class="text-inputs">
                            <span><i class="fas fa-inbox"></i> Mensaje</span>
                            <textarea name="mensaje" id="" placeholder="Escriba tu mensaje" cols="50" required></textarea>
                        </div>
                        
                        <input type="submit" class="envio" name="enviar" value="CREAR">
                    </form>
                </div>
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

        setInterval(actualizar,1000); //recorrer la funccion actualizar() en un intervalo de 1000 segundos
    </script>

    <!-- script de traer datos para imprimir en la tabla servicios-->
    <script>
        function traerDatos(){ //Funcion encargada de recoger los datos y ejecutar la siguiente funcion para darle formato

            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../src/services.php' ,true); //Hace una GET al la ruta el servidor que recoge en el archivo php (pods en este caso)

            xhttp.send();

            xhttp.onreadystatechange = function(){
                
                if(this.readyState == 4 && this.status == 200){ //Comprueba que el estado del anterior comando sea 4 y que haya respuesta 200

                    let datos = JSON.parse(this.responseText); //Guarda en una variable el json formateado
                    let datos_meta= datos.items;

                    let res= document.querySelector('#res'); //Variable en la que vamos a aplicar los cambios (#res, en el codigo html)
                    /* res.innerHTML=''; //Limpiamos los datos
                    res2.innerHTML=''; */

                    for (i=0;i<datos_meta.length;i++){ //Bucle para que salgan todos los datos //PodIP //Name //Namespace //uid //Phase   
                        if(datos.items[i].metadata.name.includes('<?php echo($emailsubstr) ?>')){ //filtro por usuario para que solo me salgan sus deploys
                            res.innerHTML += `
                            <tr>
                            <td>${datos.items[i].status.phase}</td>
                            <td>${datos.items[i].metadata.name}</td>
                            </tr>`
                            
                        }
                    }
                }
            }
        }
        traerDatos();
    </script>
</body>
</html>