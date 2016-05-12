<?
/* Include load file */
require_once('../../../../wp-load.php');
global $wpdb;	
global $redux_demo;	

$post_id=$_GET['id'];
$zillow_key=$redux_demo['zillo-wapi-id'];
$minPageHeight='700';	

$start='0';
$ordering=array();

if(isset($redux_demo['report-prepared-show']) && $redux_demo['report-prepared-show']=='1'):
	$ordering['prepared']=(isset($redux_demo['report-prepared-squence']) && !empty($redux_demo['report-prepared-squence']))?$redux_demo['report-prepared-squence']:0;
endif;
if(isset($redux_demo['report-contact-show']) && $redux_demo['report-contact-show']=='1'):
	$ordering['contact']=(isset($redux_demo['report-contact-squence']) && !empty($redux_demo['report-contact-squence']))?$redux_demo['report-contact-squence']:0;
endif;
if(isset($redux_demo['report-about-show']) && $redux_demo['report-about-show']=='1'):
	$ordering['about']=(isset($redux_demo['report-about-squence']) && !empty($redux_demo['report-about-squence']))?$redux_demo['report-about-squence']:0;
endif;
if(isset($redux_demo['report-map-show']) && $redux_demo['report-map-show']=='1'):
	$ordering['map']=(isset($redux_demo['report-map-squence']) && !empty($redux_demo['report-map-squence']))?$redux_demo['report-map-squence']:0;
endif;
if(isset($redux_demo['report-comparable-list-show']) && $redux_demo['report-comparable-list-show']=='1'):
	$ordering['comparable-list']=(isset($redux_demo['report-comparable-list-squence']) && !empty($redux_demo['report-comparable-list-squence']))?$redux_demo['report-comparable-list-squence']:0;
endif;
if(isset($redux_demo['report-property-detail-show']) && $redux_demo['report-property-detail-show']=='1'):
	$ordering['property-detail']=(isset($redux_demo['report-property-detail-squence']) && !empty($redux_demo['report-property-detail-squence']))?$redux_demo['report-property-detail-squence']:0;
endif;
if(isset($redux_demo['report-photos-listing-show']) && $redux_demo['report-photos-listing-show']=='1'):
	$ordering['photos-listing']=(isset($redux_demo['report-photos-listing-squence']) && !empty($redux_demo['report-photos-listing-squence']))?$redux_demo['report-photos-listing-squence']:0;
endif;
if(isset($redux_demo['report-comparative-analysis-show']) && $redux_demo['report-comparative-analysis-show']=='1'):
	$ordering['comparative-analysis']=(isset($redux_demo['report-comparative-analysis-squence']) && !empty($redux_demo['report-comparative-analysis-squence']))?$redux_demo['report-comparative-analysis-squence']:0;
endif;
if(isset($redux_demo['report-property-analysis-show']) && $redux_demo['report-property-analysis-show']=='1'):
	$ordering['property-analysis']=(isset($redux_demo['report-property-analysis-squence']) && !empty($redux_demo['report-property-analysis-squence']))?$redux_demo['report-property-analysis-squence']:0;
endif;

$reporting=array(
			'prepared'=>'forReport',
			'contact'=>'branding',
			'about'=>'about',
			'map'=>'map_of_all',
			'comparable-list'=>'single_prop',
			'property-detail'=>'prop_detail',
			'comparative-analysis'=>'analysis',
			'property-analysis'=>'analysis_text',
		);

	asort($ordering);

	if($post_id):
			$find_place=get_post_meta($post_id,'req_place',true);
			$zpid=get_post_meta($post_id,'req_zpid',true);
			$full_name=get_post_meta($post_id,'req_frist_name',true).' '.get_post_meta($post_id,'req_last_name',true);
			
			if(!empty($zpid)): 
				$compare_results=array();
				$photos=array();
				
				$stateZipArray=explode(',',$find_place);
				
				$place=$stateZipArray[0];
				$stateZip=$stateZipArray[2];
				
				/* Get Main Data */
				$data=getZillowMainData($zillow_key,$place,$stateZip);				
				
				if(isset($data->response)):
					$latitude=(string) $data->response->results->result->address->latitude;
					$longitude=(string) $data->response->results->result->address->longitude;
					
					/* Comparable Data */
					if($redux_demo['report-comparable-list-show']=='1'):
						$compare_results=getZillowCompareReuslts($zillow_key,$zpid,$redux_demo['report-comparable-list-value']);
					endif;

					/* Get Photos Data */
					if($redux_demo['report-photos-listing-show']=='1'):
						$photos=getZillowPropertyImages($zillow_key,$zpid,$redux_demo['report-photos-listing-value']);
					endif;	
					
					/* Now Include the Page For Html */	
					include_once (plugin_dir_path( __FILE__ ) . '/report/complete_report.php');
			
				endif;
				
			endif;
	
	endif;		
?>
