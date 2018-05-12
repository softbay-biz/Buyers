<?php
function search_geolocalisation($ArrayData){
  		if(isset($ArrayData->longitude) AND isset($ArrayData->latitude)){
			include 'Helpers/Bd.php';
        		$bdd = bd();
			    $longitude = utf8_decode(strip_tags($ArrayData->longitude));
			    $latitude = utf8_decode(strip_tags($ArrayData->latitude));
			    $lastId = strip_tags($ArrayData->lastId);
			    $data = [];
			    $informations = array();
                try{
						$request = $bdd->prepare('SELECT * FROM annonce WHERE longitude != 0 AND latitude != 0');
	                    $request->execute(array('name' => $name,'lastId' => $lastId));
					}catch(Exception $e){
					 echo "Erreur lors de la collecte des donnees de la BD!";
					}				
					while($infos = $request->fetch()){
						if(calculDistance($_POST['latitude'],$_POST['longitude']),$infos['latitude'],$infos['longitude']){
								  $informations['id'] = $infos['id_annonce'];
			                      $informations['categorie'] = utf8_encode($infos['categorie']);
			                      $informations['nom'] = utf8_encode($infos['nom']);
			                      $informations['prix']	= $infos['prix'];
			                      $informations['ville'] = utf8_encode($infos['localisation']);
			                      $informations['img1_Vignette_200px'] = $path1.utf8_encode($infos['url1']);
			                      $informations['img1_Vignette_800px'] = $path2.utf8_encode($infos['url1']); 
			                      $informations['img2_Vignette_200px'] = $path1.utf8_encode($infos['url2']);  
			                      $informations['img2_Vignette_800px'] = $path2.utf8_encode($infos['url2']); 
			                      $informations['img3_Vignette_200px'] = $path1.utf8_encode($infos['url3']);
			                      $informations['img3_Vignette_800px'] = $path2.utf8_encode($infos['url3']);
			                      $informations['longitude'] = $infos['longitude'];
			                      $informations['latitude'] = $infos['latitude'];
			                      $informations['date_inscription'] = $infos['dateInsc']; 
			                      array_push($data,$informations);
			                      unset($informations);            
					}
			            }			   
					}					
			return json_encode($data);
			$request->closeCursor();
			unset($data);
}else{
		   return echo json_encode(array('message' => 'Incorrect received data!'));
}
}
?>