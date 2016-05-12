<div class="map_of_all" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>
	
	<table style="width:100%;">
		<tr>
			<td style="width:85%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">MAP OF ALL LISTINGS</td>
			<td style="background:#5477BB;color:#fff;font-size:24px;font-weight:bold; border-left: 3px solid rgb(242, 180, 17); padding: 15px 0px 15px 14px;">MAP</td>
		</tr>
	</table>	
		
	<div style="clear:both;"></div><br/><br/>
    <div id="map-canvas" style='text-align: center;'>
		<img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=800x372&maptype=roadmap<?php foreach($otherPorperties as $key=>$value):?>&markers=color:red%7Clabel:P%7C<?=$value['latitude']?>,<?=$value['longitude']?><?php endforeach;?>&key=<?=$redux_demo['google-map-api']?>"/>
	</div>
	
	<br/><br/><br/><br/>
	<table style='width:100%;font-size: 18px;'>
		<tr style="background:#666666;color:#fff;text-align: left;"><th style="padding:8px;">MLS #</th><th style="padding:8px;">Address</th><th style="padding:8px;">Price</th></tr>
		<?php foreach($otherPorperties as $key=>$value):?>
			<tr>
				<td style="padding: 7px;background:#CCCCCC"><?=$value['zpid']?></td>
				<td style="padding: 7px;background:#CCCCCC"><?=$value['address']?></td>
				<td style="padding: 7px;background:#CCCCCC;color:#2E99D1;">$<?=number_format($value['list_price'],0)?></td>
			</tr>
		<?php endforeach;?>
	</table>

	<div style='clear:both;'></div>
</div>