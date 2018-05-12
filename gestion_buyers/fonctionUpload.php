<?php
function uploadFile($path1,$path2,$path3){
				//On vérifie que l'url appartient au système
			//header('Access-Control-Allow-Origin: http://buyers.com,http://buyers.cm');
			  $repertoire_original = 'pictures_annonces/';
			//Tableau contenant la liste des nom  des input de type file
			  $tab_file = array($path1,$path2,$path3);
			//Mon tableau d'images			
			  $tab_nom = array();
			foreach($tab_file as $val){
				        if (isset($_FILES[$val])){
									$infos_fichier = pathinfo($_FILES[$val]['name']);
									$temp = explode('.', $_FILES[$val]['name']);
					                $extension_fichier = end($temp);
					                $file_size = $_FILES[$val]['size'];		
									$extensions_autorisees = array('jpg','jpeg','png','PNG','JPG','JPEG');				
									if(in_array($extension_fichier,$extensions_autorisees) AND $file_size <= 4194304) {			
										$nomFile = reset($temp);
										$salt = 'rgorl'.mt_rand().'g$*buyers'.date('s');
										$nomFile.= $salt;
										$nomFile = openssl_digest($nomFile,'sha512');
										$nomFile = str_shuffle($nomFile);
										$file = $nomFile.'.'.$extension_fichier;
										//On enregistre d'abord l'image originale
										  move_uploaded_file($_FILES[$val]['tmp_name'],$repertoire_original.$file);	
										  //On convertie l'image originale		
										    //petite image 600 * 600																
											  fct_redim_image(800,800,'','','',$repertoire_original.$file);																			  
											  copy('pictures_annonces/'.$file,'pictures_annonces/vignette/800/'.$file);											  
											  //On enrgistre le noms ds fichierrs dans un tableau 
											  //petite image 200 * 200
											  fct_redim_image(200,200,'','','',$repertoire_original.$file);
											  copy('pictures_annonces/'.$file,'pictures_annonces/vignette/200/'.$file);
											    array_push($tab_nom,'pictures_annonces/vignette/200/'.$file);
											    array_push($tab_nom,'pictures_annonces/vignette/800/'.$file);	
											    unlink($repertoire_original.$file);								  																					  								  
											  $message = array('Images enregistrées!');													
								    }else $message = array('Fichier non compatible!');
						}	

			            else{ 
					        $message = array('Fichiers non existant!');
				        }			}
			     // echo json_encode($message);
			      unset($_FILES['file1'],$_FILES['file2'],$_FILES['file3'],$tab_file);
	return $tab_nom;
}

	function fct_redim_image($Wmax, $Hmax, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
		  // ------------------------------------------------------------------
		 $condition = 0;
		  // Si certains paramètres ont pour valeur '' :
		   if ($rep_Dst == '') { $rep_Dst = $rep_Src; }  // (meme repertoire)
		   if ($img_Dst == '') { $img_Dst = $img_Src; }  // (meme nom)
		   if ($Wmax == '') { $Wmax = 0; }
		   if ($Hmax == '') { $Hmax = 0; }
		  // ------------------------------------------------------------------
		  // si le fichier existe dans le répertoire, on continue...
		 if (file_exists($rep_Src.$img_Src) && ($Wmax!=0 || $Hmax!=0)) { 
		    // ----------------------------------------------------------------
		    // extensions acceptées : 
		   $ExtfichierOK = '" jpg jpeg png JPG PNG JPEG"';  // (l espace avant jpg est important)
		    // extension
		   $tabimage = explode('.',$img_Src);
		   $extension = $tabimage[sizeof($tabimage)-1];  // dernier element
		   $extension = strtolower($extension);  // on met en minuscule
		    // ----------------------------------------------------------------
		    // extension OK ? on continue ...
		   if (strpos($ExtfichierOK,$extension) != '') {
		       // -------------------------------------------------------------
		       // récupération des dimensions de l image Src
		      $size = getimagesize($rep_Src.$img_Src);
		      $W_Src = $size[0];  // largeur
		      $H_Src = $size[1];  // hauteur
		       // -------------------------------------------------------------
		       // condition de redimensionnement et dimensions de l image finale
		       // -------------------------------------------------------------
		       // A- LARGEUR ET HAUTEUR maxi fixes
		      if ($Wmax != 0 && $Hmax != 0) {
		         $ratiox = $W_Src / $Wmax;  // ratio en largeur
		         $ratioy = $H_Src / $Hmax;  // ratio en hauteur
		         $ratio = max($ratiox,$ratioy);  // le plus grand
		         $W = $W_Src/$ratio;
		         $H = $H_Src/$ratio;   
		         $condition = ($W_Src>$W) || ($W_Src>$H);  // 1 si vrai (true)
		      }
		       // -------------------------------------------------------------
		       // B- LARGEUR maxi fixe
		      if ($Hmax != 0 && $Wmax == 0) {
		         $H = $Hmax;
		         $W = $H * ($W_Src / $H_Src);
		         $condition = $H_Src > $Hmax;  // 1 si vrai (true)
		      }
		       // -------------------------------------------------------------
		       // C- HAUTEUR maxi fixe
		      if ($Wmax != 0 && $Hmax == 0) {
		         $W = $Wmax;
		         $H = $W * ($H_Src / $W_Src);         
		         $condition = $W_Src > $Wmax;  // 1 si vrai (true)
		      }
		       // -------------------------------------------------------------
		       // on REDIMENSIONNE si la condition est vraie
		       // -------------------------------------------------------------
		      if ($condition == 1) {
		          // création de la ressource-image"Src" en fonction de l extension
		          // et on crée une ressource-image"Dst" vide aux dimensions finales
		         switch($extension) {
		         case 'jpg':
		         case 'jpeg':
		           $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
		           $Ress_Dst = ImageCreateTrueColor($W,$H);
		           break;
		         case 'png':
		           $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
		           $Ress_Dst = ImageCreateTrueColor($W,$H);
		            // fond transparent (pour les png avec transparence)
		           imagesavealpha($Ress_Dst, true);
		           $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
		           imagefill($Ress_Dst, 0, 0, $trans_color);
		           break;
		         }
		          // ----------------------------------------------------------
		          // REDIMENSIONNEMENT (copie, redimensionne, ré-echantillonne)
		         ImageCopyResampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src); 
		          // ----------------------------------------------------------
		          // ENREGISTREMENT dans le répertoire (avec la fonction appropriée)
		         switch ($extension) { 
		         case 'jpg':
		         case 'jpeg':
		           ImageJpeg ($Ress_Dst, $rep_Dst.$img_Dst);
		           break;
		         case 'png':
		           imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
		           break;
		         }
		          // ----------------------------------------------------------
		          // libération des ressources-image
		         imagedestroy ($Ress_Src);
		         imagedestroy ($Ress_Dst);
		      }
		       // -------------------------------------------------------------
		   }
		 }
		// --------------------------------------------------------------------------------------------------
		  // retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
		  // si le fichier a bien été créé
		 if ($condition == 1 && file_exists($rep_Dst.$img_Dst)) {return true; }
		 else { return false; }
}
?>