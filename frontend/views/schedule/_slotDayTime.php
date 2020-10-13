<style>
	.label:before, .label:after{
		content:none !important;
	}
</style>
<?php 
if(!empty($slotDayTime))
{
	foreach($slotDayTime as $slott){
?>

<div class="col-md-3" style="padding-top:10px;padding-bottom: 10px;margin-left: 10px">
	
	<span class="label label-success"><?php echo date_format(date_create($slott->from_time),'H:i a').' - '.date_format(date_create($slott->to_time),'H:i a')?></span>
</div>
<?php 
}
}else{
?>
<div class="col-md-12" style="padding-top:10px;padding-bottom: 10px">
	Sorry no time slot available
</div>
<?php 	
}
?>

                