// Variable Globale pour s'assurer que la popup ne s'excecute pas plusieurs fois
let allowToast = true;
// Popup de buyers
function PopUpAnnonce()
 {
     const body = document.getElementById("body");
     const geolocData = document.getElementById("geolocData");
     let matchMedia = window.matchMedia("(max-width: 650px)").matches;
     let thumbnailCount = 0;
     let imagesList = [];
     // Cette variable sert a savoir quelle est le nombre d'images deja pretes a etre uploadé
     let thumbnailDisplay = 0;
     // Clé de l'api de Google Place cette clé est sous liste blanche seul le site www.buyers.com peut l'utiliser
     const urlGooGlePlace = `https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=${geolocData.dataset.lat},${geolocData.dataset.lon}&radius=500&key=AIzaSyAGxA2f5bPL05olw7jLVEF9rlAMT7yOiSA`;
     let workerGooglePlace = new Worker("js/workers/findGooglePlace.js");
         workerGooglePlace.postMessage(urlGooGlePlace);
         workerGooglePlace.addEventListener("message", (e) =>
          { 
            if(e.data === "erreur")
             {
                const objectLocation = document.getElementById("objectLocation");
                      objectLocation.disabled = false;
                      objectLocation.style.opacity = 1;
             }
          });
     let constructPopup = `<div class="overlay" id="removeOverlay">
      <div id="popUp" class="animated bounceIn">
       <div class="entetePopUp">
       <a href="#close" class='closePopUp' id="closePopUpConnexion"></a>
       <div class="titre">D&eacute;poser une annonce</div>
       </div>
       <span id='loaderMultiColor' class="progressbar-infinite color-multi hide"></span>
       <div class="bodyPopUp">
        <input type="text" placeholder="Entrez le nom de l'objet" id="objectName" />
        <input type="text" placeholder="Entrez votre numero de telephone" id="objectUserTel" />
        <input type="text" placeholder="Entrez le prix de l'objet(ex:1000 Fcfa)" id="objectPrice" />
        <select id="objectCategory">
        <option value="Choisir un secteur">Choisir un secteur</option>
         <option value="Informatique">Informatique</option>
         <option value="electromenager">Electromenager</option>
         <option value="immobilier">Immobilier</option>
        </select>
        <select id="objectLocation" disabled style="opacity:0.4;transition:opacity ease .3s">
         <option value="Géolocaliser mon annonce">Géolocaliser mon annonce</option>
         <option value="Bamenda">Bamenda</option>
         <option value="Bafoussam">Bafoussam</option>
         <option value="Bangante">Banganté</option>
         <option value="Bertoua">Bertoua</option>
         <option value="Buea">Buea</option>
         <option value="Douala">Douala</option>
         <option value="Dschang">Dschang</option>  
         <option value="Ebolowa">Ebolowa</option>
         <option value="Edea">Edea</option>
         <option value="Garoua">Garoua</option>
         <option value="Kribi">kribi</option>
         <option value="Maroua">Maroua</option>
         <option value="Nkongsamba">Nkongsamba</option>
         <option value="Ngaoundere">Ngaoundéré</option>
         <option value="Limbe">Limbé</option>
         <option value="Sangmelima">Sangmélima</option>
         <option value="Yaounde">Yaoundé</option>
        </select>
        <div id="objectDescription"contenteditable>Description de l objet</div>
        <div id="zoneUpload">
          <span id="thumbnail1"></span>
          <span id="thumbnail2"></span>
          <span id="thumbnail3"></span>
        </div>
       </div>
       <div id="clickFooter" class="footerPopUp">
          <input type="file" name="file" id="file" class="inputfile" accept="image/*";capture="camera" multiple />
          <label for="file" tabindex="0">Choisir un fichier</label>
          <span id="posterAnnonce">Publier votre annonce</span>
       </div>
       </div>
     </div>`;
     body.insertAdjacentHTML("beforeend", constructPopup);
     const closePopUpConnexion = document.getElementById("closePopUpConnexion");
     const removeOverlay = document.getElementById("removeOverlay");
     const thumbnail1 = document.getElementById("thumbnail1");
     const thumbnail2 = document.getElementById("thumbnail2");
     const thumbnail3 = document.getElementById("thumbnail3");
     const file = document.getElementById("file");
        closePopUpConnexion.addEventListener("click", (e) =>
         {
              e.preventDefault();
              let CloneClosePopUp = new ClosePopUp(removeOverlay);
         });
        file.addEventListener("change", function()
         {
              const selfFiles = this.files;
              let allowedExtensions = ["jpg", "jpeg", "png", "webp"];
              let thumbnailPath = [];              
              let execToast;
              let filesLength = selfFiles.length;
              if(filesLength > 3)
               {
                 if(matchMedia === true)
                  {
                     alert("Vous ne pouvez pas uploader plus de 3 elements");
                  }
                 else
                  {
                     execToast = new Toast("icons/error.svg","Vous ne pouvez pas uploader plus de 3 elements", 3000);
                  }
                   
               }
              else
               {
                  for(let i=0; i<filesLength; i++)
                   {
                      imgType = selfFiles[i].name.split(".");
                      imgType = imgType.pop().trim().toLowerCase();
                      if(imgType.length > 2 && imgType.length <= 4)
                       {
                         if(allowedExtensions.includes(imgType) === true)
                          {
                            let fileSize = selfFiles[i].size / 1000;
                            if(fileSize > 4000)
                             {
                               if(matchMedia === true)
                                {
                                  alert("Taille de(s) image(s) trop grande. maximum = 4MO/image");
                                }
                               else
                                {
                                  execToast = new Toast("icons/error.svg","Taille de(s) image(s) trop grande. maximum = 4MO/image", 3000);
                                }
                             }
                            else
                             {                              
                               let execCreateThumbnail = new CreateThumbnail(selfFiles[i]);
                             }
                          }
                         else
                          {
                            if(matchMedia === true)
                             {
                                alert("Seul les fichiers aux formats jpg, png, jpeg et webp sont autorisés");
                             }
                            else
                             {
                                execToast = new Toast("icons/error.svg","Seul les fichiers aux formats jpg, png, jpeg et webp sont autorisés", 3000);
                             }
                             
                          }
                      }
                     else
                      {
                        if(matchMedia === true)
                         {
                           alert("Fichier invalide");
                         }
                        else
                         {
                           execToast = new Toast("icons/error.svg","Fichier invalide", 3000);
                         }
                         
                      }
                  }
              }
           // Fonction de creation de thumbnail, cette fonction retourne une requete ajax qui upload les fichiers
           function CreateThumbnail(files)
            {
              let reader = new FileReader();
                  reader.addEventListener("load", function()
                   {  
                      thumbnailDisplay++;
                      thumbnailPath.push(this.result);
                      imagesList.push(this.result);
                      let thumbnailPathLength = thumbnailPath.length;
                      if(thumbnailPathLength === 1)
                       {
                          if(thumbnailCount === 0)
                           {
                              thumbnail1.style.backgroundImage = `url(${thumbnailPath[0]})`;
                              thumbnailCount = 1;
                           }
                          else if(thumbnailCount === 1)
                           {
                             thumbnail2.style.backgroundImage = `url(${thumbnailPath[0]})`;
                             thumbnailCount = 2;
                           }
                          else if(thumbnailCount === 2)
                           {
                             thumbnail3.style.backgroundImage = `url(${thumbnailPath[0]})`;
                           }
                           
                       }
                      else if(thumbnailPathLength === 2)
                       {
                         thumbnailCount = 1;
                         if(thumbnailCount === 1)
                          {
                              thumbnail1.style.backgroundImage = `url(${thumbnailPath[0]})`;
                              thumbnail2.style.backgroundImage = `url(${thumbnailPath[1]})`;
                              thumbnailCount = 2;
                          }
                         else if(thumbnailCount === 2)
                          {
                             thumbnail3.style.backgroundImage = `url(${thumbnailPath[2]})`;
                             thumbnailCount = 0;
                          }
                          
                       }
                      else if(thumbnailPathLength === 3)
                       {
                                thumbnail1.style.backgroundImage = `url(${thumbnailPath[0]})`;
                                thumbnail2.style.backgroundImage = `url(${thumbnailPath[1]})`;
                                thumbnail3.style.backgroundImage = `url(${thumbnailPath[2]})`;
                                thumbnailCount = 0;
                       }
                   });
                  reader.readAsDataURL(files);
                  
            }
         });
     // envoi de l'annonce  
     posterAnnonce.addEventListener("click", () =>
      {
          let objectName_value = document.getElementById("objectName").value;
          let objectUserTel_value = document.getElementById("objectUserTel").value;
          let objectPrice_value = document.getElementById("objectPrice").value;
          let objectCategory_value = document.getElementById("objectCategory").value;
          const objectLocation = document.getElementById("objectLocation");
          let objectLocation_value = document.getElementById("objectLocation").value;
          let objectDescription_value = document.getElementById("objectDescription").textContent;
          if(objectName_value === "" || objectPrice_value === "" || objectCategory_value === "Choisir un secteur" || objectDescription_value === "" || objectUserTel_value === "")
           {
             if(matchMedia === true)
                {
                   alert("Veuillez remplir tout les champs");
                }
              else
                {
                  execToast = new Toast("icons/error.svg","Veuillez remplir tout les champs", 3000);
                }
              
           }
          else if(objectLocation.disabled === false && objectLocation_value === "Géolocaliser mon annonce" )
           {
              if(matchMedia === true)
                {
                   alert("Choisissez une ville pour votre annonce");
                }
              else
                {
                  execToast = new Toast("icons/error.svg","Choisissez une ville pour votre annonce", 3000);
                }
           }
          else if( thumbnailDisplay < 3)
           {
              if(matchMedia === true)
                {
                   alert("Vous devez envoyer 3 photos pour votre annonce");
                }
              else
                {
                  execToast = new Toast("icons/error.svg","Vous devez envoyer 3 photos pour votre annonce", 3000);
                }
           }
          else
           {
            var formDataToSend = {
              requestName:btoa(btoa(btoa("add_product"))),
              data:{
                category:objectCategory_value,
                name:objectName_value,
                price:objectPrice_value,
                tel:objectUserTel_value,
                localisation:objectLocation_value,
                images:imagesList,
                longitude:0,
                latitude:0,
                description:objectDescription_value
              }
            };            
              const loaderMultiColor = document.getElementById("loaderMultiColor");
              const urlToSend = "API/entryPoint.php";
              let xhrSendAnnonce = new XMLHttpRequest();
                  xhrSendAnnonce.addEventListener("loadstart", () =>
                   {    
                        loaderMultiColor.style.display = "block";
                   });
                  xhrSendAnnonce.addEventListener("load", () =>
                   {
                        let response = JSON.parse(xhrSendAnnonce.responseText);
                        ClosePopUp(removeOverlay);
                        return new Toast("icons/done.svg",response.message, 3000);
                   });
                  xhrSendAnnonce.addEventListener("error",()=>{
                    //console.log(e.error);
                  })
             xhrSendAnnonce.responseType = "text";
	           xhrSendAnnonce.open('POST',urlToSend, true);
	          xhrSendAnnonce.send(JSON.stringify(formDataToSend));
           }
          
      });
  
 }
 // Fonction de fermeture de popUp
 function ClosePopUp(domNodeRemovePopUp)
  {
    const body = document.getElementById("body");
    let removePopUp = body.removeChild(domNodeRemovePopUp);
        removePopUp = null;
  }