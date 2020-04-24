<?php
/**
* conectar
*/
date_default_timezone_set('America/Dominica');
class Conexion
{
	asdas
	public static function conectar()
	{
		if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1" || $_SERVER["REMOTE_ADDR"] == "::1")
			{
		    
		    $link = new PDO("mysql:host=localhost;dbname=uapa", 
							"root", 
							"", 
							array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								 PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")	
							);
							
			return $link;
		        
		}else{

			$link = new PDO("mysql:host=localhost;dbname=uapa", 
							"btsprous_public", 
							"fXZfCs0n7wKU",

							 
							array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								 PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

						
							);
			return $link;

		}

	}

}
