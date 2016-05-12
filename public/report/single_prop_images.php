<div class="for_single_prop" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>

	<table style="width:100%;">
		<tr>
			<td style="width:70%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">LISTING PHOTOS</td>
			<td style="background:#5477BB;color:#fff;font-size:24px;font-weight:bold; border-left: 3px solid rgb(242, 180, 17); padding: 15px 0px 15px 14px;">MLS #<?php echo $property['zpid'];?></td>
		</tr>
	</table>
	
    <br/><br/>
	
	<?php foreach($property['images'] as $kk=>$img):?>
			<img style="width: 32.6%;max-height:300px;" src="<?=$img?>"/>
	<?php endforeach;?>
	<div style='clear:both;'></div>
</div>