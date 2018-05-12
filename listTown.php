<?php
//On importe la BD
include("BD.php");

//On liste les élements
   try{
        $localisation = array();
		$localisation['ville'] = array();

		$request = $bdd->prepare('SELECT localisation FROM localisation');
	    $request->execute();
	}catch(Exception $e){
		echo "Erreur lors de la collecte des categories de la BD!";
	}				
		while($infos = $request->fetch()){
			//On vérifie  que la chaine de caractère entrée par l'utilisateur est une sous chaine du non du produit
			    array_push($localisation['ville'],utf8_encode($infos['localisation']));				   
	}
			echo json_encode($localisation);
?>