this.addEventListener("message", function(e)
 {
       "use strict";
        let self = this;
        let xhrGooglePlaceInfos = new XMLHttpRequest();
	    xhrGooglePlaceInfos.addEventListener("load", function success()
		 {
			let responseGooglePlace;
			responseGooglePlace = JSON.parse(xhrGooglePlaceInfos.responseText);
			// self.postMessage(country_name);
            console.log(xhrGooglePlaceInfos);
		 });
	    xhrGooglePlaceInfos.addEventListener("error", function error()
	     {
			    var errorMessage = "erreur";
				self.postMessage(errorMessage);				   
	     });
        // xhrGooglePlaceInfos.setRequestHeader("X-My-Custom-Header", "some value");
        
	    xhrGooglePlaceInfos.responseType = "text";
	    xhrGooglePlaceInfos.open('GET', e.data, true);
        xhrGooglePlaceInfos.setRequestHeader('Access-Control-Allow-Origin', '*');
	    xhrGooglePlaceInfos.send(null);
 });