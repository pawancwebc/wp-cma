<div class="for_single_prop" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>

	<table style="width:100%;">
		<tr>
			<td style="width:70%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">PROPERTY DETAIL</td>
			<td style="background:#5477BB;color:#fff;font-size:24px;font-weight:bold; border-left: 3px solid rgb(242, 180, 17); padding: 15px 0px 15px 14px;">MLS #<?php echo $property['zpid'];?></td>
		</tr>
	</table>
	
    <br/>
    <table style="width:100%;font-weight: bold; color: rgb(242, 180, 17); font-size: 28px;">
			<tr>
				<td style="width:60%"><?php echo $property['name'];?></td>
				<td style='text-align:right;'>$<?=number_format($value['list_price'],0)?></td>
			</tr>
	</table>
	<br/><br/>
	<table style='width:100%;font-size: 15px;'>
		<tr style="background:#666666;color:#fff;text-align: left;"><th style="padding:8px;" colspan='4'>Property information</th></tr>
		
			<tr>
				<td style="padding: 7px;background:#CCCCCC"><b>Zillow Home ID#:</b> <?php echo $property['zpid'];?></td>
				<td style="padding: 7px;background:#CCCCCC"><b>Bedrooms:</b> <?php echo $property['bedrooms'];?></td>
				<td style="padding: 7px;background:#CCCCCC"><b>Sq Ft:</b> <?php echo $property['lotSizeSqFt'];?></td>
				<td style="padding: 7px;background:#CCCCCC"><b>Last Sold Date:</b> <?php echo $property['lastSoldDate'];?></td>
			</tr>
			<tr>
				<td style="padding: 7px;background:#CCCCCC"><b>Usage:</b> </td>
				<td style="padding: 7px;background:#CCCCCC"><b>Baths:</b> <?php echo $property['bathrooms'];?></td>
				<td style="padding: 7px;background:#CCCCCC"><b>Year Built:</b> <?php echo $property['yearBuilt'];?></td>
				<td style="padding: 7px;background:#CCCCCC;"><b>Last Sold Price:</b> <font style="color:#2E99D1;">$<?php echo $property['lastSoldPrice'];?></font></td>
			</tr>
	</table>
	<br/><br/>
	
	
	<?php if(!empty($property['features'])):?>
		<table style='width:100%;font-size: 15px;'>
			<tr style="background:#666666;color:#fff;text-align: left;"><th style="padding:8px;" >Features</th></tr>
			<tr>
				<td style="padding: 15px;background:#CCCCCC">
					<?php foreach($property['features'] as $kk=>$vv):?>
						<b><?=$kk?></b>: <?=$vv?>&nbsp;&nbsp;&nbsp; 
					<?php endforeach;?>	
				</td>
			</tr>		
		</table>
		<br/><br/>
	<?php endif;?>
	
	<?php if(!empty($property['desc'])):?>
		<table style='width:100%;font-size: 15px;'>
			<tr style="background:#666666;color:#fff;text-align: left;"><th style="padding:8px;" >Remarks</th></tr>
			<tr>
				<td style="padding: 15px;background:#CCCCCC">
					<?=$property['desc']?>
				</td>
			</tr>		
		</table>		
	<?php endif;?>	
	
	<div style='clear:both;'></div>
</div>