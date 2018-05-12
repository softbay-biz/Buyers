<?php
 $_POST['nom'] = 'é';
        $_POST['lastId'] = 1;
  		if(isset($_POST['longitude']) AND isset($_POST['latitude'])){
  			include('fonctions.php');
			include('BD.php');
			    //$lastId = strip_tags($_POST['lastId']);
			    $informations = array();
			    $informations['Id'] = array();
			    $informations['Categorie'] = array();
			    $informations['Nom'] = array();
			    $informations['Prix'] = array();
			    $informations['Ville'] = array();
			    $informations['Tel'] = array();
			    $informations['Description'] = array();
			    $informations['url1'] = array();
			    $informations['url2'] = array();
			    $informations['url3'] = array();
			    $informations['url4'] = array();
			    $informations['url5'] = array();
			    $informations['url6'] = array();
			    $informations['Latitude'] = array();
			    $informations['Longitude'] = array();
			    $informations['Date_inscription'] = array();
                try{
						$request = $bdd->prepare('SELECT * FROM annonce WHERE longitude != 0 AND latitude != 0');
	                    $request->execute(array('name' => $name,'lastId' => $lastId));
					}catch(Exception $e){
					 echo "Erreur lors de la collecte des donnees de la BD!";
					}				
					while($infos = $request->fetch()){
						if(calculDistance($_POST['latitude'],$_POST['longitude']),$infos['latitude'],$infos['longitude']){
						//On vérifie  que la chaine de caractère entrée par l'utilisateur est une sous chaine du non du produit
			                      array_push($informations['Id'],$infos['id_annonce']);
			                      array_push($informations['Categorie'],utf8_encode($infos['categorie']));
			                      array_push($informations['Nom'],utf8_encode($infos['nom']));
			                      array_push($informations['Prix'],$infos['prix']);
			                      array_push($informations['Ville'],utf8_encode($infos['localisation']));
			                      array_push($informations['Tel'],$infos['tel']);
			                      array_push($informations['Description'],utf8_encode($infos['description']));
			                      array_push($informations['url1'],utf8_encode($infos['url1']));
			                      array_push($informations['url2'],utf8_encode($infos['url2']));
			                      array_push($informations['url3'],utf8_encode($infos['url3']));
			                      array_push($informations['url4'],utf8_encode($infos['url4']));
			                      array_push($informations['url5'],utf8_encode($infos['url5']));
			                      array_push($informations['url6'],utf8_encode($infos['url6']));
			                      array_push($informations['Longitude'],$infos['longitude']);
			                      array_push($informations['Latitude'],$infos['latitude']);
			                      array_push($informations['Date_inscription'],$infos['dateInsc']);	
			            }			   
					}					
			echo json_encode($informations);
			$request->closeCursor();
			unset($informations);
}else{
		    $message = 'Donnee non recue';
			echo json_encode($message);
			unset($message);
}
?>