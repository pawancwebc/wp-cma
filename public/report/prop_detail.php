<div class="for_single_prop" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>

	<table style="width:100%;">
		<tr>
			<td style="width:70%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">PROPERTY DETAIL</td>
			<td style="background:#5477BB;color:#fff;font-size:24px;font-weight:bold; border-left: 3px solid rgb(242, 180, 17); padding: 15px 0px 15px 14px;">MLS #<?php echo (string) $data->response->results->result->zpid;?></td>
		</tr>
	</table>
	<br/>
    <table style="width:100%;font-weight: bold; color: rgb(242, 180, 17); font-size: 28px;">
			<tr>
				<td style="width:60%"><?php echo (string) $data->response->results->result->address->street;?></td>
				<td style='text-align:right;'>$<?php echo (string) $data->response->results->result->zestimate->amount;?></td>
			</tr>
	</table>
	<br/><br/><br/>
	<table style='width:100%;font-size: 15px;'>
		<tr style="background:#666666;color:#fff;text-align: left;"><th style="padding:8px;" colspan='4'>Property information</th></tr>
		
			<tr>
				<td style="padding: 7px;background:#CCCCCC"><strong>Zillow Home ID#:</strong> <?php echo (string) $data->response->results->result->zpid;?></td>
				<td style="padding: 7px;background:#CCCCCC"><strong>Bedrooms:</strong> <?php echo (string) $data->response->results->result->bedrooms;?></td>
				<td style="padding: 7px;background:#CCCCCC"><strong>Sq Ft:</strong> <?php echo (string) $data->response->results->result->finishedSqFt;?></td>
				<td style="padding: 7px;background:#CCCCCC"><strong>Last Sold Date:</strong> <?php echo (string) $data->response->results->result->lastSoldDate;?></td>
			</tr>
			<tr>
				<td style="padding: 7px;background:#CCCCCC"><strong>Usage:</strong> <?php echo (string) $data->response->results->result->useCode;?></td>
				<td style="padding: 7px;background:#CCCCCC"><strong>Baths:</strong> </strong> <?php echo (string) $data->response->results->result->bathrooms;?></td>
				<td style="padding: 7px;background:#CCCCCC"><strong>Year Built:</strong> <?php echo (string) $data->response->results->result->yearBuilt;?></td>
				<td style="padding: 7px;background:#CCCCCC;"><strong>Last Sold Price:</strong> <font style="color:#2E99D1;">$<?php echo (string) $data->response->results->result->lastSoldPrice;?></font></td>
			</tr>
	</table>
	
	
	
	<div style='clear:both;'></div>
</div>