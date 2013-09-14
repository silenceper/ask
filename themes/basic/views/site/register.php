<?php
	$this->pageTitle="用户注册";
?>
<div class="span12" style="background-color: white;min-height:400px;">
	<div id="header">
		<h5 class="text-success">用户注册</h5>
	</div>
	<!-- loginForm start -->
	    <?php $form=$this->beginWidget('CActiveForm', array(
	    	'action'=>$this->createUrl('site/checkregister'),
			'id'=>'register-form',
			'enableClientValidation'=>true,
    		'enableAjaxValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions'=>array(
				'class'=>'form-horizontal'
			)
		)); 
	    $model=new RegisterForm();
	    ?>
	    <div class="control-group">
			<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'re_password',array('class'=>'control-label')); ?>
			<?php echo $form->passwordField($model,'re_password'); ?>
			<?php echo $form->error($model,'re_password'); ?>
		</div>
		<div class="control-group" style="margin-left:230px;">
			<button class="btn btn-primary">注册</button>
		</div>
		<?php $this->endWidget(); ?>
		<!-- end form -->
</div>
