<?php
session_start();
$email=$_SESSION['email']; //variable de email del usuario
$emailsubstr=substr($email, 0, strpos($email, '@')); //variable de nombre del usuario

//Requisitos para correr la API
require("./vendor/autoload.php");
use RenokiCo\PhpK8s\Exceptions\KubernetesAPIException;
use RenokiCo\PhpK8s\K8s;
use RenokiCo\PhpK8s\Kinds\K8sDeployment;
use RenokiCo\PhpK8s\Kinds\K8sPod;
use RenokiCo\PhpK8s\ResourcesList;
use RenokiCo\PhpK8s\KubernetesCluster;

/*VARIABLES DE FORM*/
if(isset($_POST['enviar'])){
	$nombre = $_POST['web_name'];
	$passwd = $_POST['db_passwd'];
	
	function crear_apache($nombre, $emailsubstr){
	//YAML traducido a API
	$cluster = new KubernetesCluster('https://192.168.1.30:6443');

	$container = K8s::container()
		->setName('apache')
		->setImage('httpd', 'latest')
		->setPorts([
			['name' => 'apache', 'protocol' => 'TCP', 'containerPort' => 8443],
		]);
		// Setters de los Pod
	$pod = K8s::pod()
			->setName('apache')
			->setLabels(['app' => 'web'])
			->setContainers([$container])
		->setSpec('hostname', $nombre)
		->setSpec('subdomain', 'servidor-web');
		// Setters del Deploy
	$dep = $cluster->deployment()
		->setName($nombre . '-apache-' . $emailsubstr) //$emailsubstr
		->setNamespace('webserver')
		->setSelectors(['matchLabels' => ['app' => 'web']])
		->setReplicas(1)
		->setTemplate($pod)
		->create();
	}
	crear_apache($nombre, $emailsubstr);

	//INSERTAR datos de deploy en la BD
	include("../src/dbconexion.php");
	
	$insertDeploy="INSERT INTO DEPLOYEMENT VALUES('$nombre',NOW(),'$email')";
	$returnInsert=mysqli_query($conexion,$insertDeploy);
	print("<script>alert('Se ha creado correctamente, en la parte de servicios dentro de unos intantes le saldrá su dirección');</script>");
	header( "refresh:3 ; url=../pages/dashboard.php" );
}
?>
