<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Yii::app()->name;?></title>
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">    
</head>
<body>
	<?php
		Yii::app()->clientScript->registerScriptFile(yii::app()->baseUrl.'/public/admin/js/jquery.min.js',CClientScript::POS_HEAD);
		yii::app()->clientScript->registerCssFile(yii::app()->baseUrl.'/public/admin/css/bootstrap.min.css');
		yii::app()->clientScript->registerCssFile(yii::app()->baseUrl.'/public/admin/css/admin.css');
		yii::app()->clientScript->registerScriptFile(yii::app()->baseUrl.'/public/admin/js/bootstrap.min.js');
		yii::app()->clientScript->registerScriptFile(yii::app()->baseUrl.'/public/admin/js/admin.js',CClientScript::POS_END);
	?>
   <?php echo $content;?>
 </body>
</html>