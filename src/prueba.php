<?php $nombre="admin"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="res"></div>
    <script>
        function traerDatos(){ //Funcion encargada de recoger los datos y ejecutar la siguiente funcion para darle formato

            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', './servicesjson.php' ,true); //Hace una GET al la ruta el servidor que recoge en el archivo php (pods en este caso)

            xhttp.send();

            xhttp.onreadystatechange = function(){
                
                if(this.readyState == 4 && this.status == 200){ //Comprueba que el estado del anterior comando sea 4 y que haya respuesta 200

                    let datos = JSON.parse(this.responseText); //Guarda en una variable el json formateado
                    let datos_meta= datos.items;

                    let res= document.querySelector('#res'); //Variable en la que vamos a aplicar los cambios (#res, en el codigo html)
                    res.innerHTML=''; //Limpiamos los datos

                    for (i=0;i<datos_meta.length;i++){ //Bucle para que salgan todos los datos //PodIP //Name //Namespace //uid //Phase   
                        if(datos.items[i].metadata.name.includes('<?php echo($nombre) ?>')){
                            res.innerHTML += `
                            <span>${datos.items[i].status.phase}</span>
                            <span>${datos.items[i].metadata.name}</span>
                            `
                        }
                    }
                    /* <td data-label="POD Ip">${datos.items[i].status.podIP}</td> 
                            <td data-label="Nombre">${datos.items[i].metadata.name}</td>
                            <td data-label="Namespace">${datos.items[i].metadata.namespace}</td>
                            <td data-label="UID">${datos.items[i].metadata.uid}</td>
                            <td data-label="Estado">${datos.items[i].status.phase}</td> */
                }
            }
        }
        traerDatos();
    </script>
</body>
</html>
