<?php
function search_by_category($ArrayData){   
			include 'Helpers/Bd.php';
			include 'Helpers/listCategory.php';
        	$bdd = bd();
        	$tab_categorie = listCategories();   
        if(isset($ArrayData->category) AND isset($ArrayData->lastId) AND in_array($ArrayData->category,$tab_categorie)){      	        	
			    //On encode en utf8 pour pouvoir effectuer la recherche dans la BD
			      $categorie = utf8_decode($ArrayData->category);
			      $lastId = $ArrayData->lastId;
			      $data = [];
			      $path1 = 'uploads/vignette/200/';
			      $path2 = 'uploads/vignette/800/';
			      $informations = array();
                try{
					if($ArrayData->lastId != 0){	
						$request = $bdd->prepare('SELECT * , INSTR(nom,:name) FROM annonce WHERE INSTR(nom,:name)>0 AND id_annonce > :lastId ORDER BY id_annonce DESC LIMIT 10');
	                    $request->execute(array('name' => $name,'lastId' => $lastId));
	                }else{
	                	$request = $bdd->prepare('SELECT * , INSTR(nom,:name) FROM annonce WHERE INSTR(nom,:name)>0 ORDER BY id_annonce DESC LIMIT 10');
	                    $request->execute(array('name' => $name));
	                }
					}catch(Exception $e){
					 echo "Erreur lors de la collecte des donnees de la BD!";
					}				
					while($infos = $request->fetch()){
			                      $informations['id'] = $infos['id_annonce'];
			                      $informations['categorie'] = $infos['categorie'];
			                      $informations['nom'] = $infos['nom'];
			                      $informations['prix']	= $infos['prix'];
			                      $informations['ville'] = $infos['localisation'];
			                      $informations['img1_Vignette_200px'] = $infos['url1'];
			                      $informations['img1_Vignette_800px'] = $infos['url1']; 
			                      $informations['img2_Vignette_200px'] = $infos['url2'];  
			                      $informations['img2_Vignette_800px'] = $infos['url2']; 
			                      $informations['img3_Vignette_200px'] = $infos['url3'];
			                      $informations['img3_Vignette_800px'] = $infos['url3'];
			                      $informations['longitude'] = $infos['longitude'];
			                      $informations['latitude'] = $infos['latitude'];
			                      $informations['date_inscription'] = $infos['dateInsc'];   
			                      array_push($data,$informations);
			                      unset($informations);            
					}
			return json_encode($data);
			$request->closeCursor();
			unset($data);
}else{
	return json_encode(array('message' => 'Incorrect received data!'));
}}
?>