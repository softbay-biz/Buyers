<?php
function domainOrigin(){
	//Allowed domains
	$allowed_domains = Array('https://buyers.cm','http://buyers.cm','127.0.0.1');

	if(isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'],$allowed_domains)){		
		return true;

	}else{
		return false;
	}
}
?>