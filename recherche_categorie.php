<?php

       $categorie = 'Véhicule';
       $lastId = 0;
       $tab = ['Véhicule'];
       echo Search_category($categorie,$lastId,$tab);
function Search_category($categorie,$lastId,$tab_categorie){      
        if(isset($categorie) AND isset($lastId) AND in_array($categorie,$tab_categorie)){
			include('BD.php');
			    //On ecode en utf8 pour pouvoir effctuer la recherche dans la BD
			      $categorie = utf8_decode($categorie);
			      $data = [];
			      $informations = array();
                try{
						$request = $bdd->prepare('SELECT * FROM annonce WHERE categorie = :categorie AND id_annonce > :lastId LIMIT 10');
	                    $request->execute(array('categorie'=>$categorie,'lastId'=>$lastId));
					}catch(Exception $e){
					 echo "Erreur lors de la collecte des donnees de la BD!";
					}				
					while($infos = $request->fetch()){
			                      $informations['Id'] = $infos['id_annonce'];
			                      $informations['Categorie'] = utf8_encode($infos['categorie']);
			                      $informations['Nom'] = utf8_encode($infos['nom']);
			                      $informations['Prix']	= $infos['prix'];
			                      $informations['Ville'] = utf8_encode($infos['localisation']);
			                      $informations['Img1_Vignette_200px'] = utf8_encode($infos['url1']);
			                      $informations['Img1_Vignette_800px'] = utf8_encode($infos['url1']); 
			                      $informations['Img2_Vignette_200px'] = utf8_encode($infos['url2']);  
			                      $informations['Img2_Vignette_800px'] = utf8_encode($infos['url2']); 
			                      $informations['Img3_Vignette_200px'] = utf8_encode($infos['url3']);
			                      $informations['Img3_Vignette_800px'] = utf8_encode($infos['url3']);
			                      $informations['Longitude'] = $infos['longitude'];
			                      $informations['Latitude'] = $infos['latitude'];
			                      $informations['Date_inscription'] = $infos['dateInsc']; 
			                      array_push($data,$informations);
			                      unset($informations);            
					}
			return json_encode($data);
			$request->closeCursor();
			unset($data);
}else{
		    $message = 'Donnees non recues';
			return json_encode($message);
			unset($message);
}}
?>