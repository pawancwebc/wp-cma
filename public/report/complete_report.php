<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="en-US">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Complete Report</title>
</head>
<style>
@media print {
    @page { size: A4 portrait; margin: 0; }
    body, .wrap { padding: 0; background: none; border: none; margin: 0; }
    .document { width: 180mm; height: 260mm; margin: 15mm; line-height: 1; }
    .document div { width: 100%; height: 98%; border: 1px solid red; }
}
</style>
<body>
<?php 
		$otherPorperties=array();
		
		if(!empty($compare_results)): 
			if(!empty($compare_results->response->properties->comparables)):
				foreach($compare_results->response->properties->comparables->comp as $key=>$prop):
					$single=array(
								'zpid'=>(string) $prop->zpid,
								'name'=>(string) $prop->address->street,
								'address'=>(string) $prop->address->street.' '.$prop->address->zipcode.', '.$prop->address->city.' '.$prop->address->state,
								'postal_zip'=>(string) $prop->address->zipcode.', '.$prop->address->city.' '.$prop->address->state,
								'latitude'=>(string) $prop->address->latitude,
								'longitude'=>(string) $prop->address->longitude,
								'taxAssessmentYear'=>(string) $prop->taxAssessmentYear,
								'taxAssessment'=>(string) $prop->taxAssessment,
								'yearBuilt'=>(string) $prop->yearBuilt,
								'lotSizeSqFt'=>(string) $prop->lotSizeSqFt,
								'finishedSqFt'=>(string) $prop->finishedSqFt,
								'bathrooms'=>(string) $prop->bathrooms,
								'bedrooms'=>(string) $prop->bedrooms,
								'totalRooms'=>(string) $prop->totalRooms,
								'lastSoldDate'=>(string) $prop->lastSoldDate,
								'lastSoldPrice'=>(string) $prop->lastSoldPrice,
								'bedrooms'=>(string) $prop->bedrooms,
								'list_price'=>(string) $prop->zestimate->amount,
								'zestimate'=>array(
												'average'=>(string) $prop->zestimate->amount,
												'low'=>(string) $prop->zestimate->valuationRange->low,
												'high'=>(string) $prop->zestimate->valuationRange->high,
												'per_sq_feet'=>(string) $prop->zestimate->amount/(string) $prop->finishedSqFt,
												),
							
					);
					
					$single=getZillowPropertyImagesAndFeature($zillow_key,(string) $prop->zpid,$single);
					
					$single['graph']=getZillowChart($zillow_key,(string) $prop->zpid);
				
					$otherPorperties[]=$single;
					
				endforeach;
			endif;
		endif;

		$st_no='1';
		/* for Blank Title */
		include(plugin_dir_path( __FILE__ ) . 'blank_title.php');
		
		foreach($ordering as $report_key=>$report_order):
			if($report_key=='comparable-list'):
				
				if(!empty($otherPorperties)):
					foreach($otherPorperties as $si_key=>$property):
						/* for Single Property */
						include(plugin_dir_path( __FILE__ ) . 'single_prop.php');
						
						if(isset($property['graph']) && !empty($property['graph'])):
							/* for Single Property Graph*/
							include(plugin_dir_path( __FILE__ ) . 'single_prop_graph.php');
						endif;
						
						if(isset($property['images']) && !empty($property['images']) && (isset($redux_demo['report-photos-listing-show']))):					
							/* for Single Property Images*/
							include(plugin_dir_path( __FILE__ ) . 'single_prop_images.php');					
						endif;
					endforeach;				
				endif;				
			else:
				include_once (plugin_dir_path( __FILE__ ) . $reporting[$report_key].'.php');	
			endif;
		$st_no++;	
		endforeach;		
	?>
</body>
</html>	