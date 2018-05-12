<?php
 				// On vérifie que l'url appartient au système
 header('Access-Control-Allow-Origin: http://buyers.com,http://buyers.cm');
 header('Content-Type: text/html; charset=UTF-8');
 $nom = strip_tags($_POST['nom']);
 $prix = strip_tags($_POST['prix']);
 $tel = strip_tags($_POST['tel']);

 $categorie = strip_tags($_POST['categorie']);
 $description = strip_tags($_POST['description']);
 $booleanTocheckLocation = strip_tags($_POST['booleanTocheckLocation']);
 //On vérifie que les valeurs receuillies sont non vides
  if(isset($nom) AND isset($prix) AND isset($tel) AND isset($description) AND isset($booleanTocheckLocation))
  {
    // include("fonctions.php");
    include('BD.php');
    include("liste_tableaux.php");
    include("fonctionUpload.php");
    //  decodeArrayToUtf8($arrayToCheckCategorie);
    // On verifie que la categorie de données est valide
    if(in_array($categorie, $arrayToCheckCategorie) == true)
     {
  	    //Traitement des données
        // On verifie que la ville est valide en la comparant a la valeur du boolean string $booleanTocheckLocation et en verifiant qu'elle est dans le tableau $arrayToCheckLocation
        if(strcmp($booleanTocheckLocation, "Ville") == 0)
         {
           $localisation = strip_tags($_POST['localisation']);
          //  decodeArrayToUtf8($localisation, $arrayToCheckLocation);
           if(in_array($localisation, $arrayToCheckLocation) == true)
            {
               $t = uploadFile('file1','file2','file3');
               var_dump($t);
              //Enregistrement de l'annone dans la BD
             try
              {
              //Insertion des données de l'annonce dans la base de donnée
                  $req = $bdd->prepare('INSERT INTO annonce(nom,prix,tel,categorie,localisation,description,dateInsc) 
                                            VALUES(:nom, :prix, :tel, :categorie, :localisation, :description, NOW())');
                  $req->execute(array(
                                          'nom' => $nom,
                                          'prix' => $prix,
                                          'tel' => $tel,
                                          'categorie' => $categorie,
                                          'localisation' => $localisation,
                                        	'description' => $description
                                          // 'url1' => $url1,
                                          // 'url2' => $url2,
                                          // 'url3' => $url3,
                                          ));
                   $messageReturn = array(
                       "message" => "Insertion faite"
                  );
                 echo json_encode($messageReturn);
               
             }
             catch(Exception $i)
             {
                  echo "Erreur lors de la sauvegarde des donnees de l'annonce!";
             } 
            }
           else
            {
               echo "Veuillez choisir une Ville appropriée";
            } 
         }
       else if(strcmp($booleanTocheckLocation, "latlon") == 0)
        { 
           $latitude = strip_tags($_POST['latitude']);
           $longitude = strip_tags($_POST['longitude']);
            //Enregistrement de l'annone dans la BD
             try
              {
              //Insertion des données de l'annonce dans la base de donnée
                  $req = $bdd->prepare('INSERT INTO annonce(nom,prix,tel,categorie,latitude, longitude,description,dateInsc) 
                                            VALUES(:nom, :prix, :tel, :categorie, :latitude, :longitude, :description, NOW())');
                  $req->execute(array(
                                          'nom' => $nom,
                                          'prix' => $prix,
                                          'tel' => $tel,
                                          'categorie' => $categorie,
                                          'latitude' => $latitude,
                                          'longitude' => $longitude,
                                        	'description' => $description
                                          // 'url1' => $url1,
                                          // 'url2' => $url2,
                                          // 'url3' => $url3,
                                          ));
                   $messageReturn = array(
                       "message" => "Insertion faite"
                  );
                 echo json_encode($messageReturn);
               
             }
             catch(Exception $i)
             {
                  echo "Erreur lors de la sauvegarde des donnees de l'annonce!";
             }
           
        }
    }
   else
    {
       echo "Veuillez choisir une categorie appropriée";
    }
  }
  else {
    $message_error = array(
      "message_error" => "mauvais"
      );
    echo json_encode($message_error);
  }
?>