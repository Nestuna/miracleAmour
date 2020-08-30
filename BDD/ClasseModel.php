<?php

/*Username: t84EM39Jzz

Database name: t84EM39Jzz

Password: qYcZYWZUPb

Server: remotemysql.com

Port: 3306


CLASSE MODEL de notre BDD*/

class Model{
	
	private $pdo_driver = 'Mysql';         
	private $pdo_host = 'remotemysql.com';			 
	private $pdo_dbname = 't84EM39Jzz';    
	private $pdo_login = 't84EM39Jzz';           
	private $pdo_password = 'qYcZYWZUPb';           

	private $bd;
	
	private static $instance = null;

	private function __construct(){
		try{
			$dsn = $this->pdo_driver.':'.'host='.$this->pdo_driver.';dbname='.$this->pdo_dbname;
			$this->bd = new PDO($dsn, $this->pdo_login, $this->pdo_password);
			$this->bd->query('SET NAMES utf8');
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
		}
	}

	public static function getModel(){
		if (is_null(self::$instance))
			self::$instance = new Model();
		return self::$instance;
	}

}

?>

<?php

/*Connexion à la bdd depuis une page php.*/

require_once ('CLasseModel.php');
$model = Model::getModel(); //créer une connexion à la base de donnée et la classe Model

try{
	$bd=new PDO('mysql:host=remotemysql.com;dbname=t84EM39Jzz', 't84EM39Jzz', 'qYcZYWZUPb');
	$bd->query("SET NAMES 'utf8'");
	$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
	die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '. $e->getMessage().'</p>');
}

?>



