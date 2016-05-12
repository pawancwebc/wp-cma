<?
/* Include load file */
require_once('../../../../wp-load.php');
error_reporting(E_ALL);
global $wpdb;	
global $redux_demo;	


require_once(plugin_dir_path( __FILE__ ) .'report/dompdf/dompdf_config.inc.php');



$post_id=$_GET['id'];
if($post_id):
	$post_url=PROP_PLUGIN_WS_PATH.'public/report.php?id='.$post_id;
	$file_pdf_name='request-'.$post_id;			
	//echo $post_url; exit;
	$html = file_get_contents($post_url);
	$dompdf = new DOMPDF();
	$dompdf->load_html(utf8_decode($html));
	//$dompdf->load_html(html_entity_decode($html));
	//$dompdf->set_paper('27x21', 'portrait');
	$dompdf->render();
	$dompdf->stream($file_pdf_name.".pdf");
	exit;
endif;

?>