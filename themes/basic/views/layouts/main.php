<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?> - <?php echo Yii::app()->name;?> </title>
</head>
	
<body>
	<script type="text/javascript">
	<?php
		if(!Yii::app()->user->isGuest):
	?>
		var g_user={
				uid:<?php echo Yii::app()->user->id;?>,
				username:'<?php echo Yii::app()->user->getState('userInfo')->username;?>',
				email:'<?php echo Yii::app()->user->getState('userInfo')->email;?>',
				avatar_file:'<?php echo Yii::app()->user->getState('userInfo')->avatar_file;?>',
				sex:'<?php echo Yii::app()->user->getState('userInfo')->sex;?>',
				login:true
			};
	<?php 
		else:
	?>
		var g_user={
				login:false
				};
	<?php 
		endif;
	?>
	</script>
    	<!-- 导航条 -->
        <div class="navbar navbar-fixed-top navbar-inverse">
        	<div class="navbar-inner">
            	<div class="container">
                	<a href="/" class="brand" style="margin-right:120px;">ASK</a>
                	<div class="nav-collapse collapse navbar-inverse-collapse">
                    	<form method="get" class="navbar-search pull-left" action="<?php echo $this->createUrl('search/index');?>">
                      		<input type="text" name="word" id="search_word" class="search-query span4" placeholder="搜索问题">
                    	</form>
                        <?php $this->widget('zii.widgets.CMenu',array(
                        	'htmlOptions'=>array(
                        		'class'=>'nav',
								'style'=>'margin-left:20px;',		
							),
							'items'=>array(
								array('label'=>'问题', 'url'=>array('/site/index')),
							),
						)); ?>
                        <!--  用户名头像下拉 -->
                        <ul class="nav pull-right">
                        <?php 
                        	//用户已经登入
                        	if(!Yii::app()->user->isGuest):
                        ?>	
                        	<li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                	<img style="width:20px;height:20px;" src="<?php echo Yii::app()->user->getState('userInfo')->avatar_file; ?>">
                                    <span style="color:white;"><?php echo Yii::app()->user->getState('userInfo')->username; ?></span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                     	<a href="<?php echo $this->createUrl('user/index',array('uid'=>Yii::app()->user->id)) ?>"><i class="icon-home"></i>主页</a> 
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                     	<a href="<?php echo $this->createUrl('account/index') ?>"><i class="icon icon-cog"></i>设置</a> 
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="<?php echo $this->createUrl('site/logout')?>"><i class="icon-off"></i>退出</a>
                                    </li>
                                </ul>
                            </li>
                         <?php 
                        	//用户已经登入
                        	else:
                        ?>
                        	<li>
                        		<a href="#loginModal" data-toggle="modal" style="color:#FFF"><i class="icon-user icon-white"> </i>登入/注册</a>
                        	</li>
                        <?php 
                        	endif;
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $content;?>
         <!--===============footer start-->
        <div class="footer">
        	<div class="container">
                <p class="text-left">
                   <i class="icon-adjust"></i> Design by silenceper！<br/>
                   <small>本程序使用PHP+MYSQL构建！</small>
                </p>
            </div>
        </div>
        
		<!-- Modal弹出登入层 -->
		<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h6 id="myModalLabel">登入</h6>
		  </div>
		  <div class="modal-body">
		  <!-- loginForm start -->
		    <?php $form=$this->beginWidget('CActiveForm', array(
		    	'action'=>$this->createUrl('site/checkLogin'),
				'id'=>'login-form',
				'enableClientValidation'=>true,
	    		'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
				'htmlOptions'=>array(
					'class'=>'form-horizontal'
				)
			)); 
		    $model=new LoginForm();
		    ?>
		   	<div class="text-center">
		  	<?php echo $form->error($model,'email',array('class'=>'alert alert-error')); ?>
			<?php echo $form->error($model,'password',array('class'=>'alert alert-error')); ?>
		   	</div>
			<div class="control-group input-prepend">
				<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
				<div class="controls">
					<span class="add-on">
						<i class="icon-envelope"></i>
					</span>
					<?php echo $form->textField($model,'email'); ?>
				</div>
			</div>
			<div class="control-group input-prepend">
				<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
				<div class="controls">
					<span class="add-on">
						<i class="icon-asterisk"></i>
					</span>
					<?php echo $form->passwordField($model,'password'); ?>
				</div>
				<?php echo $form->error($model,'password'); ?>
			</div>
			<div class="control-group">
				<?php echo $form->checkBox($model,'rememberMe',array('class'=>'control-label login_checkbox')); ?>
				<div class="controls">
					<?php echo $form->labelEx($model,'rememberMe',array('class'=>'login_label')); ?>
				</div>
			</div>
			<div class="control-group" style="text-align: center;margin-left:100px;">
                    <button type="submit" class="btn btn-info span2">登录</button>
                    <a href="<?php echo $this->createUrl('site/register')?>" class="btn span2">注册</a>
            </div>
			<?php $this->endWidget(); ?>
			<!-- end form -->
		  </div>
		</div>
		<!-- end Modal弹出登入层 -->
		
<script src="<?php echo yii::app()->theme->baseUrl?>/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>