document.addEventListener("DOMContentLoaded", () =>
 {
    "use strict";
     buyersInit();
 }, {passive:true, capture:false});

// Fonction d'initialisation de Buyers;
 function buyersInit()
  {
  	"use strict";
   if(localStorage.navigatorCheckVersion === undefined)
    {
  	var navigatorUA = navigator.userAgent;
  	var isChromium = !!window.chrome;
   	var isFirefox = !!window.sidebar;
   	var isSafari = /constructor/i.test(window.HTMLElement);
   	// let isEdge =document.documentMode || /Edge/.test(navigator.userAgent);
  	var linkDownload;
  	var updateMessageTemplate = "";
  	var execCreateMessage;
  	var updateMessage = document.getElementById("updateMessage");
  	if(isChromium )
  	 {
  	   var regxChrome = /Chrom(e|ium)\/([0-9]+)\./;
       var chromeVersion = navigatorUA.match(regxChrome)[2];
  	   if(chromeVersion < 49)
  	    {
          execCreateMessage= new CreateMessage('Chrome', 'https://www.google.com/chrome/browser/desktop/');
  	    }
  	   else
  	     {
  	     	localStorage.navigatorCheckVersion = btoa("true");
  	     }
  	 }
  	 else if(isFirefox)
  	 {
        var regxFirefox = /Firefox\/([0-9]+)\./;
  	    var firefoxVersion = navigatorUA.match(regxFirefox)[1];
  	    if(firefoxVersion < 45)
  	     {
          execCreateMessage = new CreateMessage('Firefox', 'https://www.mozilla.org/fr/firefox/new/');
  	     }
  	    else
  	     {
  	     	localStorage.navigatorCheckVersion = btoa("true");
  	     }
  	 }
  	else if(isSafari === true)
  	 {
  	 	execCreateMessage = new CreateMessage('Safari', 'https://support.apple.com/fr-cm/HT204416');
  	 }
  	else if(isSafari === false)
  	 {
  	 	localStorage.navigatorCheckVersion = btoa("true");
  	 }
  	else
  	 {
  	 	return false;
  	 }
  	
  	function CreateMessage(nomNavigateur, linkDownload)
  	 {
        updateMessageTemplate += "<span>La version de "+nomNavigateur+" que vous utilisez est obsol&eacute;te veuillez la mettre a jour</span><a href="+linkDownload+" target='_blank'>Mettre a jour "+nomNavigateur+"</a>";
        updateMessage.innerHTML = updateMessageTemplate;
        updateMessage.style.display = "block";
  	 }
   }
  else
   {  /*Variable contenant la posisition du dernier produit(annonce) affiché : par défaut il vaut 0*/
      sessionStorage.setItem("productLastId",0);
   	 // Le test de version de navigateur a été passé avec succes on peut initialiser les fonctions internes de Buyers.cm
   	  handleSlider();
	  redimWindow();
	  _handleClick();
	  geolocation();
   }
  }
 // Cette fonction sert de gestionnaire de slider selon que l'on est sur un grand ecran ou bien un smartphone;
 function handleSlider()
  {
     let matchMedia = window.matchMedia("(min-width: 1024px)").matches;
     const wrapperSlider = document.getElementById("wrapperSlider");
     if(matchMedia === true)
      {
          let constructSlider = `<section id="slider">
          <div id="slider1" class="bgCover"><div id="text1" class="text">YAOUNDE</div></div>
          <div id="slider2" class="bgCover"><div id="text2" class="text">DOUALA</div></div>
          <div id="slider3" class="bgCover"><div id="text3" class="text">YAOUNDE</div></div>
          <div id="slider4" class="bgCover"><div id="text4" class="text">LIMBE</div></div>
          </section>
          <span id="lArrow"></span>
          <span id="rArrow"></span>`;
          wrapperSlider.classList.add("boxShadow");
          wrapperSlider.innerHTML = constructSlider;
          const slider = document.getElementById("slider");
          _slider(wrapperSlider,slider);
      } 
     else
      {
        let constructBg = `<div id="text4" class="text mobileText">LIMBE</div>`;
		 wrapperSlider.classList.add("boxShadow", "bgCover");
		 wrapperSlider.style.backgroundImage = "url(img/slider/google-telephone-low-cost.jpg)";
         wrapperSlider.innerHTML = constructBg;
      }
  }
  // Cette fonction permet de parametrer et de gerer le slider
function _slider(wrapperSliderBlock, sliderBlock)
 {
 	let cloneSlideMove;
 	let sliderNumber = 1;
 	
 	      wrapperSliderBlock.onclick = (e) =>
 	       {
              if(e.target !== e.currentTarget)
               {
               	 let targetId = e.target.id;
                if(targetId === "lArrow")
               	  {
                     cloneSlideMove = new SlideMove(true);
                  }
               	 else if(targetId === "rArrow")
               	  {
               	  	 cloneSlideMove = new SlideMove(false);
               	  }
               }
 	       },{passive:true}; 
 	    function SlideMove(movement)
 	     {
 	     	if(movement === true)
 	     	 {
 	     	 	 if(sliderNumber === 1)
                      {
                       requestAnimationFrame( () =>
                        {
                           sliderBlock.style.transform = "translate3d(-100%,0,0)";
                           sliderNumber = 2;
                        }, sliderBlock);
                      	
                      }
                     else if(sliderNumber === 2)
                      {
                      	requestAnimationFrame( () =>
                        {
                         
                         sliderBlock.style.transform = "translate3d(-200%,0,0)";
                         sliderNumber = 3;
                        },sliderBlock);
                      }
                     else if(sliderNumber === 3)
                      {
                      	 requestAnimationFrame( () =>
                        {
                         
                         sliderBlock.style.transform = "translate3d(-300%,0,0)";
                         sliderNumber = 4;
                        },sliderBlock);
                      }
                     else
                      {

                      	return false;
                      }
 	     	 }
 	     	else
 	     	 {
 	     	 	if(sliderNumber === 4)
               	  	 {
               	  	 	requestAnimationFrame( () =>
               	  	 	 {
                           sliderBlock.style.transform = "translate3d(-200%,0,0)";
                           sliderNumber = 3;
               	  	 	 }, sliderBlock);
               	  	 }
               	  	else if(sliderNumber === 3)
               	  	 {
               	  	 	requestAnimationFrame( () =>
               	  	 	 {
                            sliderBlock.style.transform = "translate3d(-100%,0,0)";
                            sliderNumber = 2;
               	  	 	 }, sliderBlock);
               	  	 }
               	  	else if(sliderNumber === 2)
               	  	 {
               	  	 	requestAnimationFrame( () =>
               	  	 	 {
                            sliderBlock.style.transform = "translate3d(0,0,0)";
                            sliderNumber = 1;
               	  	 	 }, sliderBlock);
               	  	 }
               	  	else
               	  	 {
               	  	 	return false;
               	  	 }
 	     	 }
 	     }

    
 }
// Cette Fonction permet d'afficher le slider ou pas quand on redimensionne la page
function redimWindow()
 {
	 window.addEventListener("resize",handleSlider);
 }
// Cette fonction gere les evenements click sur buyers.cm
 function _handleClick()
  {
	 const menu = document.getElementById("menu");
	 const _footer = document.getElementById("_footer");
   const search_zone = document.getElementById("search_zone");
	menu.addEventListener("click", (e) =>
	 {
        _selectClick(e);
	 },{passive:true, capture:false});

  search_zone.addEventListener("click", (e)=>
  {
    _selectClick(e);
  },{passive:true, capture:false});

	_footer.addEventListener("click", (e) =>
	 {
        _selectClick(e);
	 },{passive:true, capture:false});

	 function _selectClick(event)
      {
	    event.target !== event.currentTarget;
		let targetId = event.target.id;
		let execPopUp;
		if(targetId === "depotAnnonce")
		 {
			 execPopUp = new PopUpAnnonce();
		 }
    else if(targetId === "search_simple")
     {
       const name = document.getElementById("search_by_name").value;
       const category = document.getElementById("search_by_category").value;
       const city = document.getElementById("search_by_city").value;

       let data_to_search = name||category||city;
       var search_by = "";
       if(name.value !== ""){
        search_by = "search_by_name";
       }else if(category.value !== ""){
        search_by = "search_by_category";
       }else if(city.value !== ""){
        search_by = "search_by_city";
       }
       var formDataToSend = {
              requestName:btoa(btoa(btoa(search_by))),
              data:{
                lastId:0,
                name:data_to_search,
                category:data_to_search,
                city:data_to_search
              }
            };       
        ajaxGetAnnonce(formDataToSend,"adjacentHtml");        
     }
     }
  }
  function ajaxGetAnnonce(formDataToSend,typeInsertion){
    const urlToSend = "API/entryPoint.php";
              let xhrSearchAnnonce = new XMLHttpRequest();
                  xhrSearchAnnonce.addEventListener("loadstart", () =>
                   {
                   });
                  xhrSearchAnnonce.addEventListener("load", () =>
                   {
                        let response = JSON.parse(xhrSearchAnnonce.responseText);
                        let responseTaille = response.length;
                        if(responseTaille >= 1){
                          //On initialise l'ID du dernier produit 
                          sessionStorage.setItem("lastProductId",0);
                          let i = 0;
                          const zoneAnnonces = document.getElementById("search_results");                           
                          let annonceNode = '';                                                 
                          while(i<responseTaille){
                             annonceNode = `<div class="card"><div class="enteteCard xtrabg1">
                                                    <span id="price">${response[i].prix}</span>
                                                    </div>
                                                    <div id="body_card">
                                                    ${response[i].nom} <br />
                                                    <span>${response[i].ville}</span>
                                                    </div></div>`;
                              //annonceNode.firstChild.style.background = response[i].img1_Vignette_200px;                             
                              updateDom(zoneAnnonces,annonceNode,typeInsertion);
                              i++;
                          }

                        }else{
                          return new Toast("icons/error.svg","Aucune annonce trouvée pour cette recherche!", 3000);
                        }
                        //return new Toast("icons/done.svg",response.message, 3000);
                   });
                  xhrSearchAnnonce.addEventListener("error",()=>{
                
                  });
            xhrSearchAnnonce.responseType = "text";
            xhrSearchAnnonce.open('POST',urlToSend, true);
            xhrSearchAnnonce.send(JSON.stringify(formDataToSend));
          }
//Fonction qui affiche les annonces en vérifiant que le DOM soit prêt à les recevoir
function updateDom(domNodeToUpdate,domNodeToInsert,typeOfInsertion){
  "use strict";
  return new Promise((resolve,reject)=>{
    requestAnimationFrame(()=>{
       if(typeOfInsertion === "innerHtml"){
         domNodeToUpdate.innerHTML = domNodeToInsert;
       }else if(typeOfInsertion === "adjacentHtml"){
         domNodeToUpdate.insertAdjacentHTML("beforeend",domNodeToInsert);
       }
       resolve(domNodeToUpdate);
    },domNodeToUpdate);
  });
}
// Fonction qui affiche un Toast
 function Toast(image,message, timeToHide, actionMessage, callback)
  {   
	if(allowToast === true)
	 {
	  allowToast = false;
      const body = document.getElementById("body");
	  if(actionMessage === undefined)
	   {
		   actionMessage = "";
	   }
      let constructToast = `<div id="toast"><img src="${image}" id="toastImg" />${message}<span id="actionToast">${actionMessage}</span></div>`;
      body.insertAdjacentHTML("beforeend", constructToast);
     const actionToast = document.getElementById("actionToast");
      requestAnimationFrame( () =>
       {
          toast.style.transition = "transform ease 0.3s";
          toast.style.transform = "scale3d(1,1,1)";
       }, toast);
      setTimeout( () =>
       {
         requestAnimationFrame( () =>
          {
            toast.style.transform = "scale3d(0,0,0)";
            toast.addEventListener("transitionend", () =>
             {
                let removeToast = body.removeChild(toast);
                removeToast = null;
				allowToast = true;
             });
            
          }, toast);
       },timeToHide);
	   actionToast.addEventListener("click", callback);
	}
  }
// Fonction de geolocalisation
function geolocation()
 {
	 
   let execToast;
   let matchMedia = window.matchMedia("(max-width: 650px)").matches;
   let globalGetLocation = navigator.geolocation.watchPosition(success, fail, {maximumAge:3000, timeout:30000, enableHighAccuracy: true });
   const geolocData = document.getElementById("geolocData");
   function success(position)
    {
		geolocData.dataset.lat = position.coords.latitude;
		geolocData.dataset.lon = position.coords.longitude;
	}
    
   function fail(error)
    {
		if(error.code === 1)
		 {
			if(matchMedia === true)
			 {
				 alert("Si vous refusez de vous géolocaliser vous n'aurez pas acces a toutes les fonctionnalités de Buyers");
			 }
			else
			 {
				 execToast = new Toast("icons/error.svg","Si vous refusez de vous géolocaliser vous n'aurez pas acces a toutes les fonctionnalités de Buyers", 5000);
			 }
		 }
		else if(error.code === 2)
		 {
			if(matchMedia === true)
			 {
				 alert("Les informations de géolocalisation sont indisponibles");
			 }
            else
			 {
				 execToast = new Toast("icons/error.svg","Les informations de géolocalisation sont indisponibles", 3000);
			 }
		 }
		else if(error.code === 4)
		 {
			 if(matchMedia === true)
			  {
				  alert("Erreur inconnue");
			  }
			 else
			  {
				  execToast = new Toast("icons/error.svg","Erreur inconnue", 7000);
			  }
		 }
		else
		 {
			 return false;
		 }
	}

  
 }
 /*Fonction pour l'upload du formulaire
 function formulaire(){
   alert('Formulaire');
 }*/
