<?php
    //Envio de soporte por mail
    if(isset($_POST['enviar'])){
        $select=$_POST['select'];
        $correo=$_POST['correo_soporte'];
        $asunto=$_POST['asunto_soporte'];
        $mensaje=$_POST['mensaje'];
        if($select == "op1"){ //Opcion de soporte tecnico
            //Envio de mail
            $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "dashboardjmruiz@gmail.com";
            $subject = "Soporte tecnico";
            $message = '
            <html>
            <head>
            <title>Copia de mensaje</title>
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
                                <h2 style="color: #17c200; margin: 0 0 7px">Usuario: '.$correo.'</h2>
                                <p style="margin: 2px; font-size: 15px"><b>Tipo:</b> Soporte tecnico</p>
                                <p style="margin: 2px; font-size: 15px"><b>Asunto:</b> '.$asunto.'</p>
                                <p style="margin: 2px; font-size: 15px"><b>Mensaje:</b> '.$mensaje.'</p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
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
            $headers .= 'Content-type: text/html; charset=iso-8859-1'; //Para enviar HTML

            // Envio de mail
            mail($to, $subject, $message, $headers);   
        }
        else if($select == "op2"){ //Opcion de soporte de atencion al cliente
            // Envio de mail
            $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "dashboardjmruiz@gmail.com";
            $subject = "Soporte de atencion al cliente";
            $message = '
            <html>
            <head>
            <title>Copia de mensaje</title>
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
                                <h2 style="color: #17c200; margin: 0 0 7px">Usuario: '.$correo.'</h2>
                                <p style="margin: 2px; font-size: 15px"><b>Tipo:</b> Soporte de atencion al cliente</p>
                                <p style="margin: 2px; font-size: 15px"><b>Asunto:</b> '.$asunto.'</p>
                                <p style="margin: 2px; font-size: 15px"><b>Mensaje:</b> '.$mensaje.'</p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
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

            // Envio de mail
            mail($to, $subject, $message, $headers); 
        }
        else{ //Opcion de otro tipo de soporte
            // Envio de mail
            $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "dashboardjmruiz@gmail.com";
            $subject = "Otro tipo de soporte";
            $message = '
            <html>
            <head>
            <title>Copia de mensaje</title>
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
                                <h2 style="color: #17c200; margin: 0 0 7px">Usuario: '.$correo.'</h2>
                                <p style="margin: 2px; font-size: 15px"><b>Tipo:</b> Otro tipo de soporte</p>
                                <p style="margin: 2px; font-size: 15px"><b>Asunto:</b> '.$asunto.'</p>
                                <p style="margin: 2px; font-size: 15px"><b>Mensaje:</b> '.$mensaje.'</p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
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

            // Envio de mail
            mail($to, $subject, $message, $headers);
        }

        //Envio de copia al usuario
        $from = "DashboardJMRUIZ <dashboardjmruiz@gmail.com>";
            $to = "$correo";
            $subject = "Copia de mesanje de soporte (no responda)";
            $message = '
            <html>
            <head>
            <title>Copia de mensaje</title>
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
                                <h2 style="color: #17c200; margin: 0 0 7px">Esto es una copia de su mensaje</h2>
                                <p style="margin: 2px; font-size: 15px"><b>Asunto:</b> '.$asunto.'</p>
                                <p style="margin: 2px; font-size: 15px"><b>Mensaje:</b> '.$mensaje.'</p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                                </div>
                                <p style="margin: 2px; font-size: 15px"><b>No respondas a este mensaje, en breves un tecnico le reponderá a esta misma dirección.</b></p>
                                <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
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

            // Envio de mail
            mail($to, $subject, $message, $headers);
            print("<script>alert('Se ha enviado correctamente, en breves le atenderá un tecnico por el correo solicitado.');</script>");   
            header( "refresh:0.1 ; url=../pages/dashboard.php" );
           
    }
?>