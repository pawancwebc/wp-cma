<div class="for_eport" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>
	<table style="width:100%;">
		<tr>
			<td style="width:100%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">COMPLETE REPORT</td>
		</tr>
	</table>
	<div style="clear:both;"></div><br/>
	<!-- Report Map -->
	<div class="map" style='text-align: center;'>
		<img src="http://maps.googleapis.com/maps/api/staticmap?zoom=18&size=800x372&maptype=hybrid&markers=icon:http://cdn.sstatic.net/stackoverflow/img/favicon.ico|<?=$latitude?>,<?=$longitude?>&key=<?=$redux_demo['google-map-api']?>"/>
	</div>
	<!-- Report Title -->
	<div style="margin-top: 30px; text-align: center; color: rgb(242, 180, 17); font-weight: bold; font-size: 40px; margin-bottom: 30px;"><?=$find_place?></div>

	<!-- Report Prepared For -->
	<div style="text-align: center; font-weight: bold; color: rgb(0, 0, 0); font-size: 24px; margin: 80px;">PREPARED FOR<br/><?=$full_name?><br/> ON <?=date('M d, Y',strtotime(get_post_meta($post_id,'req_date_time',true)))?></div>
	
	<div style='clear:both;'></div>
</div>