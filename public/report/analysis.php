<div class="for_single_prop" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>

	<table style="width:100%;">
		<tr>
			<td style="width:85%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">ONLINE VALUATION ANALYSIS</td>
			<td style="background:#5477BB;color:#fff;font-size:24px;font-weight:bold; border-left: 3px solid rgb(242, 180, 17); padding: 15px 0px 15px 14px;">ANALYSIS</td>
		</tr>
	</table>
	
    <br/>
	<?php 
	$low='0'; $high='0'; $per_sq='0'; $zestimate='0'; $total_pr='0';
	
	?>
	<table style='width:100%;font-size: 18px;'>
		<tr style="background:#666666;color:#fff;text-align: left;">
			<th style="padding:8px;text-align:center;" >Address</th>
			<th style="padding:8px;text-align:center;" >Low Price</th>
			<th style="padding:8px;text-align:center;" >High Price</th>
			<th style="padding:8px;text-align:center;" >Zesitmate</th>
			<th style="padding:8px;text-align:center;" >Per Sqft</th>
		</tr>
		<?php foreach($otherPorperties as $si_key=>$property): ?>
			<tr>
				<td style="padding: 7px;background:#CCCCCC"><?php echo $property['name'];?></td>
				<td style="padding: 7px;background:#CCCCCC;color:#2E99D1;text-align:right;">$<?php echo (isset($property['zestimate']['low']))?number_format($property['zestimate']['low']):'0';?></td>
				<td style="padding: 7px;background:#CCCCCC;color:#2E99D1;text-align:right;">$<?php echo (isset($property['zestimate']['high']))?number_format($property['zestimate']['high']):'0';?></td>
				<td style="padding: 7px;background:#CCCCCC;color:#2E99D1;text-align:right;">$<?php echo (isset($property['zestimate']['average']))?number_format($property['zestimate']['average']):'0';?></td>
				<td style="padding: 7px;background:#CCCCCC;color:#2E99D1;text-align:right;">$<?php echo (isset($property['zestimate']['per_sq_feet']))?number_format($property['zestimate']['per_sq_feet'],2):'0';?></td>
			</tr>
		<?php 
				$low=$low+(isset($property['zestimate']['low']))?$property['zestimate']['low']:'0';
				$high=(isset($property['zestimate']['high']))?$property['zestimate']['high']:'0';
				$zestimate=(isset($property['zestimate']['average']))?$property['zestimate']['average']:'0';
				$per_sq=(isset($property['zestimate']['average']))?$property['zestimate']['average']:'0';
				$total_pr++;
			endforeach;?>	
		<tr style="background:#666666;color:#fff;text-align: left;">
			<th style="padding:8px;text-align:center;" >Average</th>
			<th style="padding:8px;text-align:right;" >$<?=number_format($low)?></th>
			<th style="padding:8px;text-align:right;" >$<?=number_format($high)?></th>
			<th style="padding:8px;text-align:right;" >$<?=number_format($zestimate)?></th>
			<th style="padding:8px;text-align:right;" >$<?=number_format($per_sq/$total_pr)?></th>
		</tr>
	</table>
	<br/><br/>
	
	
	
</div>