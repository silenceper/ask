<?php
	$this->pageTitle=$code.' 错误';
?>
<div style="text-align:center;margin-top:20px;">
	<h2>Error <?php echo $code; ?></h2>
	
	<div class="error">
	<?php echo CHtml::encode($message); ?>
	</div>
</div>