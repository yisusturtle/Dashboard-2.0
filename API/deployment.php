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

	//wordpress
	function crear_wordpress($nombre, $passwd, $emailsubstr){
		//YAML traducido a API
	$cluster = new KubernetesCluster('https://192.168.1.30:6443');

	$container = K8s::container()
		->setName('wordpress')
		->setImage('wordpress', 'latest')
		->setEnv(['WORDPRESS_DB_NAME' => 'wordpress'])
		->addEnvs(['WORDPRESS_DB_HOST' => $nombre . '-db.servidor-web.webserver.svc.cluster.local'])
		->addEnvs(['WORDPRESS_DB_USER' => 'root'])
		->addEnvs(['WORDPRESS_DB_PASSWORD' => $passwd])
		->setPorts([
			['name' => 'wordpress', 'protocol' => 'TCP', 'containerPort' => 8443],
		]);
		// Setters de los Pod
	$pod = K8s::pod()
			->setName('wp')
			->setLabels(['app' => 'web'])
			->setContainers([$container])
		->setSpec('hostname', $nombre)
		->setSpec('subdomain', 'servidor-web');
		// Setters del Deploy
	$dep = $cluster->deployment()
		->setName($nombre . '-wordpress-' . $emailsubstr)
		->setNamespace('webserver')
		->setSelectors(['matchLabels' => ['app' => 'web']])
		->setReplicas(1)
		->setTemplate($pod)
		->create();
	}

	// Despliegue de la base de datos
	function crear_bbdd($nombre, $passwd, $emailsubstr){
		//YAML traducido a API
	$cluster = new KubernetesCluster('https://192.168.1.30:6443');

	$container_db = K8s::container()
		->setName('mariadb')
		->setImage('bitnami/mariadb', 'latest')
		->setEnv(['MARIADB_ROOT_PASSWORD' => $passwd])
		->addEnvs(['MARIADB_DATABASE' => 'wordpress'])
		->setPorts([
			['name' => 'mariadb', 'protocol' => 'TCP', 'containerPort' => 3306],
		]);
		// Setters de los Pod
	$pod_db = K8s::pod()
			->setName('wp_db')
			->setLabels(['app' => 'web'])
			->setContainers([$container_db])
		->setSpec('hostname', $nombre . '-db')
		->setSpec('subdomain', 'servidor-web');
		// Setters del Deploy

	$dep_db = $cluster->deployment()
		->setName($nombre . '-mariadb-' . $emailsubstr) 
		->setNamespace('webserver')
		->setSelectors(['matchLabels' => ['app' => 'web']])
		->setReplicas(1)
		->setTemplate($pod_db)
		->create();
	}

	crear_wordpress($nombre,$passwd,$emailsubstr);
	crear_bbdd($nombre,$passwd,$emailsubstr);
	
	include("../src/dbconexion.php");
	$insertDeploy="INSERT INTO DEPLOYEMENT VALUES('$nombre',NOW(),'$email')";
	$returnInsert=mysqli_query($conexion,$insertDeploy);
	print("<script>alert('Se ha creado correctamente, en la parte de servicios dentro de unos intantes le saldrá su dirección');</script>");
	header( "refresh:3 ; url=../pages/dashboard.php" );
}
?>
