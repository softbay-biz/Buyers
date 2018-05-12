<?php
function Add_product($ArrayData){
 //On vérifi que les valeurs receuillies sont non vides
  if(($ArrayData->localisation != "Géolocaliser") AND  ($ArrayData->category != "Catégorie")){
    include 'Modules/UploadFile.php';
    include 'Helpers/Bd.php';
    $bdd = bd();     

    $imagestab = uploadFile($ArrayData->images);
    //Traitement des donnée
        $categorie = strip_tags($ArrayData->category);
        $nom = strip_tags($ArrayData->name);
        $tel = strip_tags($ArrayData->tel);
        $prix = strip_tags($ArrayData->price); 
        $description = strip_tags($ArrayData->description);
        $localisation = strip_tags($ArrayData->localisation);
        $longitude = strip_tags($ArrayData->longitude);
        $latitude = strip_tags($ArrayData->latitude);
              //Insertion des données de l'annonce dans la base de donnée
                      $req = $bdd->prepare('INSERT INTO annonce(categorie,nom,tel,prix,localisation,description,url1,url2,url3,longitude,latitude,dateInsc) 
                                            VALUES(:categorie, :nom, :tel, :prix, :localisation, :description, :url1, :url2, :url3, :longitude, :latitude, NOW())');
                      $req->execute(array(
                                          'categorie' => $categorie,
                                          'nom' => $nom,
                                          'tel' => $tel,
                                          'prix' => $prix,
                                          'localisation' => $localisation,
                                          'description' => $description,
                                          'url1' => $imagestab[0],
                                          'url2' => $imagestab[1],
                                          'url3' => $imagestab[2],
                                          'longitude' => $longitude,
                                          'latitude' => $latitude
                                          ));
                       
    return json_encode(array('message' => 'Annonce enregistrée.'));
  }else{
    return json_encode(array('message' => 'Annonce non enregistrée!'));
  }
}  
?>