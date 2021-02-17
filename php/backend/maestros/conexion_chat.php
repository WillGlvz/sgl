<?php
	class Database extends PDO{
		public $parametros = array('host'=>'localhost', 'user'=>'Diamond', 'pass'=>'19720716', 'db'=>'chat');

		public function __construct(){
			try {
				parent::__construct('mysql:host='.$this->parametros['host'].';dbname='.$this->parametros['db'], $this->parametros['user'], $this->parametros['pass']);
				parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $ex){echo $ex->getMessage();}
		}
	}

	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$numerodeletras=15;
	$Codigo = "";
	for($i=0;$i<$numerodeletras;$i++){
		$Codigo .= substr($caracteres,rand(0,strlen($caracteres)),1);
	}
?>
