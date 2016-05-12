<?php 
/* Include load file */
require_once('../../../../wp-load.php');
error_reporting(E_ALL);
global $wpdb;	
global $redux_demo;	

require_once(plugin_dir_path( __FILE__ ) .'report/dompdf/dompdf_config.inc.php');

$post_id=$_GET['id'];
if($post_id):
	$file_pdf_name='request-'.$post_id;	
 
		$post_url=PROP_PLUGIN_WS_PATH.'public/report.php?id='.$post_id;
					
		$file_to_save = PROP_PLUGIN_FS_PATH.'public/report/download/'.$file_pdf_name.'.pdf';
		
		$html = file_get_contents($post_url);
		$dompdf = new DOMPDF();
		$dompdf->load_html(utf8_decode($html));
		
		$dompdf->render();
		$pdf_content = $dompdf->output(); // Put contents of pdf into variable for later  
		
		file_put_contents($file_to_save, $pdf_content);
		
		update_post_meta($post_id,'report_send','1');
		update_post_meta($post_id,'report_send_date',date('Y-m-d H:i:s'));				
		
		
		$first_name=get_post_meta($post_id,'req_frist_name',true);
		$last_name=get_post_meta($post_id,'req_last_name',true);
		$email=get_post_meta($post_id,'req_email',true);
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$subject = $redux_demo['branding-subject'];
		
		//Additional headers
		
		
		$headers .= 'From: '.$redux_demo['branding-title'].' <'.$redux_demo['branding-email'].'>' . "\r\n";
		
		$message = $redux_demo['branding-message-lead']."\r\n\r\n";
		
		$mail_attachment = array( $file_to_save );
		
		// Mail it
		wp_mail($email, $subject, $message, $headers,$mail_attachment);
		echo "Report Re-send Successfully";
		exit;
	
endif;	
	

?>