<meta http-equiv="refresh" content="<?php echo $time?>; url=<?php echo $url?>" />
<?php
	$this->pageTitle=$mesg;
?>
<div style="margin-top:60px;width:890px" class="text-center alert alert-info span11">
	<h5><?php echo CHtml::encode($mesg); ?><br/><?php echo $time?>秒钟后跳转~</h5>
</div>
<style type="text/css">
	.wrap{
		background-color: white !important;
	}
</style>