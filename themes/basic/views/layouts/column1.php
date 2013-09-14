<?php 
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerCssFile(yii::app()->theme->baseUrl.'/css/bootstrap.min.css');
	Yii::app()->clientScript->registerCssFile(yii::app()->theme->baseUrl.'/css/main.css');
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container wrap">
 	<div class="row" id="container_row">
		<?php echo $content; ?>
	</div>
</div><!-- content -->
<?php $this->endContent(); ?>