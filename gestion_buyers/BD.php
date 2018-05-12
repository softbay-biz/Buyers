<?php
//Connection à la BD
function bd(){
	try{	
	    //$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;//Ceci rnvoie l'erreur SQL dans catch
	    $bdd = new PDO('mysql:host=127.0.0.1;dbname=buyers', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}catch(Exception $e){
	   die('Erreur lors de la connection à la BDD.');
	}
}
?>