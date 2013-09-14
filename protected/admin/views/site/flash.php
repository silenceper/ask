<meta  http-equiv="refresh" content="<?php echo $time;?>;url=<?php echo $url;?>" />
<?php
	$this->pageTitle=$mesg;
?>
<div style="text-align:center;margin-top:20px;">
	<h4><?php echo CHtml::encode($mesg); ?></h4>
	
	<div class="error">
		<?php echo $time?>秒钟后跳转~
	</div>
</div>