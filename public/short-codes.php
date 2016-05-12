<?php 	
	// ShortCodes For plugins
	/* Function to add weather forecast to all cities */
	function property_search_show_form() {
		global $redux_demo;	
		
		$zillow_key=$redux_demo['zillo-wapi-id'];	
		if(isset($_POST['submit_request'])):
			// Now Save the Data
			global $wpdb;
			
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$subject=$_POST['frist_name'].' '.$_POST['last_name'].' Leads Request';
				// Additional headers
				$headers .= 'To: <'.$redux_demo['branding-email'].'>' . "\r\n";
				$headers .= 'From: '.$_POST['frist_name'].' '.$_POST['last_name'].' Leads Request <'.$_POST['email'].'>' . "\r\n";
				$message = '<h2>Lead Request</h2>'."\r\n\r\n";
				$message .= '
					<table>					
					<tr>
					  <td><strong>Leads Property Address :</strong></td><td>'.$_POST['p_place'].'</td>
					</tr>
					<tr>
					  <td><strong>First Name :</strong></td><td>'.$_POST['frist_name'].'</td>
					</tr>
					<tr>
					  <td><strong>Last Name :</strong></td><td>'.$_POST['last_name'].'</td>
					</tr>
					<tr>
					  <td><strong>Phone :</strong></td><td>'.$_POST['phone'].'</td>
					</tr>
					<tr>
					  <td><strong>Email :</strong></td><td>'.$_POST['email'].'</td>
					</tr>
				  </table>';
				
				// Mail it
				wp_mail($redux_demo['branding-email'], $subject, $message, $headers);
				
				$postData = array(
					 'post_title'   => "Request For :: ".$_POST['p_place'],
					 'post_content' => '',
					 'post_status'  => "publish",
					 'post_name'    => "Request For ".$_POST['p_place'],
					 'post_type'    => "req_user",
					 'post_author'    => '1'												
					 );
				
				$request_id = wp_insert_post($postData);
				update_post_meta($request_id,'req_frist_name',$_POST['frist_name']);
				update_post_meta($request_id,'req_last_name',$_POST['last_name']);
				update_post_meta($request_id,'req_email',$_POST['email']);
				update_post_meta($request_id,'req_phone',$_POST['phone']);
				update_post_meta($request_id,'req_place',$_POST['p_place']);
				update_post_meta($request_id,'req_zpid',$_POST['zpid']);
				update_post_meta($request_id,'report_send',0);
				update_post_meta($request_id,'req_date_time',date('Y-m-d H:i:s'));
		endif;
		
		$return='';   
		
		$return='
			<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
			<script type="text/javascript">
				google.maps.event.addDomListener(window, "load", function () {
					var places = new google.maps.places.Autocomplete(document.getElementById("txtPlaces"));
					google.maps.event.addListener(places, "place_changed", function () {
						var place = places.getPlace();
						var address = place.formatted_address;
						var latitude = place.geometry.location.lat();
						var longitude = place.geometry.location.lng();
						jQuery("#pro_latitude").val(latitude);
						jQuery("#pro_longitude").val(longitude);
					});
				});
			</script>
	
			<div class="property_search_div" style="width:'.$redux_demo['shortcode-search-width'].'; margin:auto;">
				<form class="property-search-form" method="Post">
					<div class="input-group">
						<input type="text" placeholder="'.$redux_demo['shortcode-placeholder'].'" value="'.((isset($_POST['p_place']))?$_POST['p_place']:'').'" id="txtPlaces" class="form-control" name="p_place">
						<input type="hidden" id="pro_latitude" name="pro_latitude" value="'.((isset($_POST['pro_latitude']))?$_POST['pro_latitude']:'').'"/>
						<input type="hidden" id="pro_longitude" name="pro_longitude" value="'.((isset($_POST['pro_longitude']))?$_POST['pro_longitude']:'').'"/>
						<button type="submit" id="header-search" name="search_property" class="btn btn-search">Locate</button>
					</div>
				</form>
			</div>
		';
		if(isset($_POST['search_property'])):
			/* Google Map */
			$stateZipArray=explode(',',$_POST['p_place']);
			
			$place=$stateZipArray[0];
			$stateZip=$stateZipArray[2];
			
			$data=getZillowMainData($zillow_key,$place,$stateZip);
			
			if(isset($data->response)):
			
				$latitude=(string) $data->response->results->result->address->latitude;
				$longitude=(string) $data->response->results->result->address->longitude;
				$zpid=(string) $data->response->results->result->zpid;
				
				$return.='<div class="property_search_result_div" style="width:'.$redux_demo['shortcode-result-width'].'; margin:auto;">
						<br/>
						<iframe width="100%" height="400" frameborder="0" disableDefaultUI="false" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$latitude.','.$longitude.'&z=14&amp;output=embed"></iframe>
						<br/>
						<div class="title_address">'.$_POST['p_place'].'</div>
						<br/>';
						
						'<div class="property_details">
							<table>
								<tr><th colspan="4">Property information</th></tr>
								<tr>
									<td><strong>Zillow Home ID#:</strong> '.$zpid.'</td>
									<td><strong>Bedrooms:</strong> '.$data->response->results->result->bedrooms.'</td>
									<td><strong>Sq Ft:</strong> '.$data->response->results->result->lotSizeSqFt.'</td>
									<td><strong>Last Sold Date:</strong> '.$data->response->results->result->lastSoldDate.'</td>
								</tr>
								<tr>
									<td><strong>Usage:</strong> '.$data->response->results->result->useCode.'</td>
									<td><strong>Baths:</strong> '.$data->response->results->result->bathrooms.'</td>
									<td><strong>Year Built:</strong> '.$data->response->results->result->yearBuilt.'</td>
									<td><strong>Last Sold Price:</strong> $'.number_format((string) $data->response->results->result->lastSoldPrice,2).'</td>
								</tr>
							</table>
						  </div>';
						  
				$return.='</div>';
			
				/* Contact Request */	
				$return.='
					<hr class="seprated_line"/>
					<div class="data_submit">
						<br/>
						<h3 class="report_email_heading">We located your property! Where should we send your report?</h3>
						<br/>
						<form class="property-email-form" method="Post">
							<div class="col-small">
								<div class="input-group">
									<lebel class="lavel_class">First Name: </lebel>
									<input type="text" name="frist_name" required placeholder="First Name"/>
								</div>
								<div class="input-group">
									<lebel class="lavel_class">Email: </lebel>
									<input type="email" name="email" placeholder="Email Address" required/>
								</div>
							</div>
							<div class="col-small">	
								<div class="input-group">
									<lebel class="lavel_class">Last Name: </lebel>
									<input type="text" name="last_name" placeholder="Last Name"/>
								</div>
								<div class="input-group">
									<lebel class="lavel_class">Phone: </lebel>
									<input type="text" name="phone" required placeholder="Phone"/>
								</div>
							</div>	
							<div class="clear"></div>
							<div class="submit_prop">								
									<input type="hidden" name="zpid" value="'.$zpid.'"/>
									<input type="hidden" name="p_place" value="'.$_POST['p_place'].'"/>
									<button class="submit_property_email" name="submit_request" />GET REPORT</button>
							</div>	
						</form>
					</div>';				
				
			else:
				$return.='<p class="error_response">'.$data->message->text.'</p>';
			endif;	
		endif;
		
		if(isset($_POST['submit_request'])):
			$return.='
			<p class="print_message"> Thank you for your request..!<br/>Complete report will be sent to you shortly!
			</p>
			';
		endif;		
		return $return;
	}
	add_shortcode('property-search', 'property_search_show_form');
	
	
?>
