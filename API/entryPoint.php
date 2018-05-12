<?php
//declare(strict_types=1);
require_once 'Modules/domainOrigin.php';
if(1/*domainOrigin() === true*/){
	//header('Access-Control-Allow-Origin:'.$_SERVER['HTTP_ORIGIN']);
	$dataReceive = json_decode(file_get_contents('php://input'));
	$data = $dataReceive->data;
	$requestName = base64_decode(base64_decode(base64_decode(strip_tags($dataReceive->requestName))));
	$allowedModules = ['add_product','search_by_name','search_by_city','search_by_category'];
	//Switching following the type of the request
	if(in_array($requestName,$allowedModules,true) === true){
		include "Modules/{$requestName}.php";
		echo $requestName($data);
	}else{
		echo json_encode(array('message' => 'Request name not found!'));
	}
}else {
	echo json_encode(array('message' => 'Domain origin not allowed!'));
}


/*	if((strip_tags($data->requestName) == 'Add_product') AND strlen($data)>=8){				
		echo Add_product(strip_tags($data),bd());

	}else if((strip_tags($data->requestName) == 'Search') AND strlen($receivedData)>=3){
		if(strip_tags($data->search_by) == 'Name'){
			include 'Modules/Search_name.php';
			echo Search_name(strip_tags($data),bd());
		}else if(strip_tags($data->Category) == 'Category'){
			
			include 'Modules/Search_category.php';
			echo Search_category(strip_tags($data),bd());
		}else if(strip_tags($data->search_by) == 'City'){
			include 'Modules/Search_city.php';
			echo Search_city(strip_tags($data),bd());
		}
	}else{
		echo 'Request name not found!';
	}
}else{
	header('Location: buyers.cm');
}*/
?>