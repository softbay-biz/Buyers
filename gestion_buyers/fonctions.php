<?php 
    function uploadFile($file){
    	$_FILES['file'] = $file;
    	$name = array();
    	//On vérifie que le fichier existe bien		
			if (isset($_FILES['file'])){
			        echo $nbFile = count($_FILES['file']['name']);
			        $allowedExts = array("jpg","JPG","png","PNG");
			        while($nbFile){
			        	        echo $_FILES['file']['name'];
							    echo $temp = explode(".", $_FILES['file']['name'][$i]);
							    $extension = end($temp);
							//On vérifie la taille du fichier et son extension		
								if (($_FILES['file']['size'][$i] <= 4194304) && in_array($extension, $allowedExts)){
								//En cas d'érreur on renvoie un message liée à cette erreur
								    if ($_FILES['file']['error'][$i] > 0) {
								    	break;
								       // echo "Return Code: ".$_FILES["file"]["error"];
								    } else {
								    	    $salt = "à(_*$=!:;,àèbuyers";
									        $filename = $_FILES['file']['name'][$i];
									        $filename .= $salt;
									        openssl_digest($filename,'sha512');									        
								            move_uploaded_file($_FILES['file']["tmp_name"],"pictures_annonces/" . $filename);	
								            //echo 'upload reussi';	
								            array_push($name,$filename);		        
								        }
								} else {
									    break;
								        echo "";
								           $message_error = array("Fichier invalide");
			                               echo json_encode($message_error);
						}		
						$nbFile--;       
					}

			}else {
			      $message_error = array("Ce fichier n'existe pas !");
			      echo json_encode($message_error);	
			    }
	    return $name;
}
// function decodeArrayToUtf8($array)
//  {
// 	 array_walk_recursive($array, function(&$item, $key){
//                 $item = utf8_decode($item);
        
//     });
 
//     return $array;
//  }
?>