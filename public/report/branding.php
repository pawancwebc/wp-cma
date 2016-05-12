<div class="branding" style='page-break-after:always;min-height:<?=$minPageHeight?>px'>
	<table style="width:100%;">
		<tr>
			<td style="width:85%;background:#5477BB;color:#fff;font-size:24px;font-weight:bold;margin-bottom:40px;border-left:25px solid rgb(242,180,17); padding: 15px 25px;">Contact Me</td>
			<td style="background:#5477BB;color:#fff;font-size:24px;font-weight:bold; border-left: 3px solid rgb(242, 180, 17); padding: 15px 0px 15px 14px;">INTRO</td>
		</tr>
	</table>
	<div style='clear:both;height:30px;'></div>
	
	<table style='width:100%'>	
	<tr>	
		<td class="left_logo" style="width: 40%;margin-right: 30px; overflow:hidden;">
		<?php 
			if(!empty($redux_demo['branding-logo']['url'])):  ?>
				<img style="width:300px; padding-top: 2%; padding-bottom: 2%; padding-left: 2%; background: #fff; border: none; margin-right: 20px;" src="<?=$redux_demo['branding-logo']['url']?>"/>
		<?php	
			else: ?>
				<img style="width:300px; padding-top: 2%; padding-bottom: 2%; padding-left: 2%; background: rgb(204, 204, 204) none repeat scroll 0% 0%; border: 1px solid; margin-right: 20px;" src="img/house-logo.png"/>
		<?php		
			endif;
		?>	
		
		</td>	
		<td style="">
			<? if(!empty($redux_demo['branding-title'])):?>
				<div style="font-weight: bold; font-size: 30px;"><?=$redux_demo['branding-title']?></div>
			<? endif;?>	
			<div style="color: rgb(242, 180, 17); font-weight: bold; font-size: 20px; margin-bottom: 30px;">
			<? if(!empty($redux_demo['branding-slogan'])):?>
				<?=$redux_demo['branding-slogan']?>
			<? endif;?>	
			</div>
			<div>
				<table style="font-size: 18px; width: 100%;">
				<tr><td>Phone</td><td>	<?=$redux_demo['branding-phone']?></td></tr>
				<tr><td>Email</td><td>	<?=$redux_demo['branding-email']?></td></tr>
				<tr><td>Web</td><td>	<?=$redux_demo['branding-website']?></td></tr>
				<tr><td>Address</td><td>	<?=$redux_demo['branding-address']?></td></tr>
				</table>
			</div>
		</td>
	</tr>	
	</table>	
		<div style='clear:both;height:30px;'></div>
		<div>
			<?=html_entity_decode($redux_demo['branding-businness'])?>
		</div>
		

	<div style='clear:both;'></div>
</div>