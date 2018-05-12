<?php 
function bd(){
	try{	
	    //$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;//Ceci rnvoie l'erreur SQL dans catch
	    $bdd = new PDO('mysql:host=127.0.0.1;dbname=buyers', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		return $bdd;
	}catch(Exception $e){
	   return 'Error data base connection!';
	}
}
function Search_category($categorie,$lastId,$tab_categorie,$bdd){      
        if(isset($categorie) AND isset($lastId) AND in_array($categorie,$tab_categorie)){
			    //On encode en utf8 pour pouvoir effectuer la recherche dans la BD
			      $categorie = utf8_decode($categorie);
			      $data = [];
			      $path1 = 'pictures_annonces/vignette/200/';
			      $path2 = 'pictures_annonces/vignette/800/';
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
			                      $informations['Img1_Vignette_200px'] = $path1.utf8_encode($infos['url1']);
			                      $informations['Img1_Vignette_800px'] = $path2.utf8_encode($infos['url1']); 
			                      $informations['Img2_Vignette_200px'] = $path1.utf8_encode($infos['url2']);  
			                      $informations['Img2_Vignette_800px'] = $path2.utf8_encode($infos['url2']); 
			                      $informations['Img3_Vignette_200px'] = $path1.utf8_encode($infos['url3']);
			                      $informations['Img3_Vignette_800px'] = $path2.utf8_encode($infos['url3']);
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
			return 'Incorrect received data!';
}}
function Search_name($nom,$lastId,$bdd){
  		if(isset($nom) and isset($lastId)){
			    $name = utf8_decode(strip_tags($nom));
			    $lastId = strip_tags($lastId);
			    $data = [];
			    $path1 = 'pictures_annonces/vignette/200/';
			    $path2 = 'pictures_annonces/vignette/800/';
			    $informations = array();
                try{
						$request = $bdd->prepare('SELECT * , INSTR(nom,:name) FROM annonce WHERE INSTR(nom,:name)>0 AND id_annonce > :lastId LIMIT 10');
	                    $request->execute(array('name' => $name,'lastId' => $lastId));
					}catch(Exception $e){
					 echo "Erreur lors de la collecte des donnees de la BD!";
					}				
					while($infos = $request->fetch()){
			                      $informations['Id'] = $infos['id_annonce'];
			                      $informations['Categorie'] = utf8_encode($infos['categorie']);
			                      $informations['Nom'] = utf8_encode($infos['nom']);
			                      $informations['Prix']	= $infos['prix'];
			                      $informations['Ville'] = utf8_encode($infos['localisation']);
			                      $informations['Img1_Vignette_200px'] = $path1.utf8_encode($infos['url1']);
			                      $informations['Img1_Vignette_800px'] = $path2.utf8_encode($infos['url1']); 
			                      $informations['Img2_Vignette_200px'] = $path1.utf8_encode($infos['url2']);  
			                      $informations['Img2_Vignette_800px'] = $path2.utf8_encode($infos['url2']); 
			                      $informations['Img3_Vignette_200px'] = $path1.utf8_encode($infos['url3']);
			                      $informations['Img3_Vignette_800px'] = $path2.utf8_encode($infos['url3']);
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
			return 'Incorrect received data!';
}}

function Search_city($city,$lastId,$bdd){
  		if(isset($city) and isset($lastId)){
			    $name = utf8_decode(strip_tags($city));
			    $lastId = strip_tags($lastId);
			    $data = [];
			    $path1 = 'pictures_annonces/vignette/200/';
			    $path2 = 'pictures_annonces/vignette/800/';
			    $informations = array();
                try{
						$request = $bdd->prepare('SELECT * , INSTR(localisation,:localisation) FROM annonce WHERE INSTR(localisation,:localisation)>0 AND id_annonce > :lastId LIMIT 10');
	                    $request->execute(array('localisation' => $city,'lastId' => $lastId));
					}catch(Exception $e){
					 echo "Erreur lors de la collecte des donnees de la BD!";
					}				
					while($infos = $request->fetch()){
			                      $informations['Id'] = $infos['id_annonce'];
			                      $informations['Categorie'] = utf8_encode($infos['categorie']);
			                      $informations['Nom'] = utf8_encode($infos['nom']);
			                      $informations['Prix']	= $infos['prix'];
			                      $informations['Ville'] = utf8_encode($infos['localisation']);
			                      $informations['Img1_Vignette_200px'] = $path1.utf8_encode($infos['url1']);
			                      $informations['Img1_Vignette_800px'] = $path2.utf8_encode($infos['url1']); 
			                      $informations['Img2_Vignette_200px'] = $path1.utf8_encode($infos['url2']);  
			                      $informations['Img2_Vignette_800px'] = $path2.utf8_encode($infos['url2']); 
			                      $informations['Img3_Vignette_200px'] = $path1.utf8_encode($infos['url3']);
			                      $informations['Img3_Vignette_800px'] = $path2.utf8_encode($infos['url3']);
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
			return 'Incorrect received data!';			
}}
    
?>