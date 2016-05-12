<?php 
/* Function for session message */
if (!function_exists('set_error_message')) {
	function set_error_message($msg,$type){
		@session_start();
		if(isset($_SESSION['error_msg'])):  
			unset($_SESSION['error_msg']);
		endif;	
		
		$_SESSION['error_msg']['msg']=$msg;
		$_SESSION['error_msg']['error']=$type;
	
		return true;
	}
}

/* Function To Get Response */
if (!function_exists('getZillowResponse')) {
	function getZillowResponse($request){
		$xml = file_get_contents($request);	
		$xml = preg_replace('#&(?=[a-z_0-9]+=)#', '&amp;', $xml);
		$feed_data = simplexml_load_string($xml);
		if(is_object($feed_data)):
			return $feed_data;
		else:	
			return false;
		endif;
	}
}

/* Function To Get  Main Data */
if (!function_exists('getZillowMainData')) {
	function getZillowMainData($zillow_key,$place,$stateZip){
		$request="http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=".$zillow_key."&address=".urlencode($place)."&citystatezip=".ltrim(urlencode($stateZip));
	
		$feed_data = getZillowResponse($request);
		if(is_object($feed_data)): 
			return $feed_data;
		else:	
			return false;
		endif;
	}
}


/* Function To Get Response */
if (!function_exists('getZillowCompareResponse')) {
	function getZillowCompareReuslts($zillow_key,$zpid,$total='5'){
		
		$request="http://www.zillow.com/webservice/GetDeepComps.htm?zws-id=".$zillow_key."&zpid=".$zpid."&count=".$total;
		
		$feed_data = getZillowResponse($request);
		if(is_object($feed_data)):
			return $feed_data;
		else:	
			return false;
		endif;
	}
}

/* Function To Get Response */
if (!function_exists('getZillowPropertyImages')) {
	function getZillowPropertyImages($zillow_key,$zpid,$total=5){
		//$zpid='48749425';
	 	$request="http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=".$zillow_key."&zpid=".$zpid;
		
		$feed_data = getZillowResponse($request);
		if(is_object($feed_data)):
			$images=array();
			if(isset($feed_data->response->images->image)):
				foreach($feed_data->response->images->image as $kkey=>$value):
						$rec=(array) $value->url;
						$images[]=$rec[0];	
				endforeach;
			endif;
			return $images;
		else:	
			return false;
		endif;		
		
	}
}

/* Function To Get Response */
if (!function_exists('getZillowPropertyImagesAndFeature')) {
	function getZillowPropertyImagesAndFeature($zillow_key,$zpid,$property){
		//$zpid='48749425';
	 	$request="http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=".$zillow_key."&zpid=".$zpid;
		
		$images=array();
		$features=array();
		$desc='';
		
		$feed_data = getZillowResponse($request);
		if(is_object($feed_data)):
			
			if(isset($feed_data->response->images->image)):
				foreach($feed_data->response->images->image as $kkey=>$value):
						$rec=(array) $value->url;
						$images[]=$rec[0];	
				endforeach;
			endif;
			
			if(isset($feed_data->response->editedFacts)):
				if(isset($feed_data->response->editedFacts->numRooms)):
					$features['No of Rooms']=(string) $feed_data->response->editedFacts->numRooms;
				endif;
				if(isset($feed_data->response->editedFacts->rooms)):
					$features['Rooms']= (string) $feed_data->response->editedFacts->rooms;
				endif;
				if(isset($feed_data->response->editedFacts->numFloors)):
					$features['No of Floors']= (string) $feed_data->response->editedFacts->numFloors;
				endif;
				if(isset($feed_data->response->editedFacts->basement)):
					$features['Basement']= (string) $feed_data->response->editedFacts->basement;
				endif;
				if(isset($feed_data->response->editedFacts->roof)):
					$features['Roof']= (string) $feed_data->response->editedFacts->roof;
				endif;
				if(isset($feed_data->response->editedFacts->floorCovering)):
					$features['Floor Covering']= (string) $feed_data->response->editedFacts->floorCovering;
				endif;
				if(isset($feed_data->response->editedFacts->exteriorMaterial)):
					$features['Exterior Material']= (string) $feed_data->response->editedFacts->exteriorMaterial;
				endif;
				if(isset($feed_data->response->editedFacts->view)):
					$features['View']= (string) $feed_data->response->editedFacts->view;
				endif;
				if(isset($feed_data->response->editedFacts->parkingType)):
					$features['Parking Type']= (string) $feed_data->response->parkingType->view;
				endif;
				if(isset($feed_data->response->editedFacts->coveredParkingSpaces)):
					$features['Parking Spaces']= (string) $feed_data->response->coveredParkingSpaces->view;
				endif;
				if(isset($feed_data->response->editedFacts->heatingSources)):
					$features['Heating Sources']= (string) $feed_data->response->editedFacts->heatingSources;
				endif;
				if(isset($feed_data->response->editedFacts->heatingSystem)):
					$features['Heating System']= (string) $feed_data->response->editedFacts->heatingSystem;
				endif;
				if(isset($feed_data->response->editedFacts->coolingSystem)):
					$features['Cooling System']= (string) $feed_data->response->editedFacts->coolingSystem;
				endif;
				if(isset($feed_data->response->editedFacts->appliances)):
					$features['Appliances']= (string) $feed_data->response->editedFacts->appliances;
				endif;
			endif;
		
			
			if(isset($feed_data->response->homeDescription)):
				$desc=(string) $feed_data->response->homeDescription;
			endif;
		endif;	

		$property['images']=$images;	
		$property['features']=$features;	
		$property['desc']=$desc;	
		
		return $property;
		
	}
}


/* Function To Get Chart */
if (!function_exists('getZillowChart')) {
	function getZillowChart($zillow_key,$zpid){
		
		$request="http://www.zillow.com/webservice/GetChart.htm?zws-id=".$zillow_key."&zpid=".$zpid."&unit-type=dollar&zpid=48749425&width=600&height=300";

		$feed_data = getZillowResponse($request);
		
		if(is_object($feed_data) && isset($feed_data->response->url)):
			return (string)$feed_data->response->url;
		else:	
			return false;
		endif;
	}
}






/* Function To Print Array */
if (!function_exists('pr')) {
	function pr($post){
		echo '<pre>';
			print_r($post);
		echo '</pre>';
	}
}
?>