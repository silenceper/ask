<?php 
	$this->pageTitle=Yii::app()->user->getState('userInfo')->username.'账户信息';
?>
<div class="span12 account" style="background:#FFF;min-height:500px">
	
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		 <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab1" data-toggle="tab">账户</a></li>
		    <li><a href="#tab2" data-toggle="tab">密码</a></li>
		    <li><a href="#tab3" data-toggle="tab">头像</a></li>
		 </ul>
	  	
	<!--form start -->
	<?php $form = $this->beginWidget('CActiveForm', array(
	    'id'=>'account-form',
	    'action'=>$this->createUrl('checkAccount'),
	    'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
	)); ?>

	  <div class="tab-content">
	    <div class="tab-pane active" id="tab1">
			<div class="control-group">
			    <label class="control-label" for="email">Email</label>
			    <div class="controls">
			      <input type="text" id="email" name='email' value="<?php echo $user_model->email; ?>" readonly="true">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="username">用户名</label>
			    <div class="controls">
			      <input type="text" id="username" value="<?php echo $user_model->username; ?>" name="username">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="mobile">手机号</label>
			    <div class="controls">
			      <input type="text" id="mobile" value="<?php echo $user_model->mobile; ?>" name="mobile">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="sex">性别</label>
			    <div class="controls">
			      <select name="sex" id="sex">
			      	<option value=""></option>		
					<option value="male" <?php if($user_model->sex=='male')echo 'selected'?>>男</option>
					<option value="female" <?php if($user_model->sex=='female')echo 'selected'?>>女</option>				      	
			      </select>
			    </div>
		  	</div>
	    </div>
	    <div class="tab-pane" id="tab2">
			<div class="control-group">
			    <label class="control-label" for="old_password">原始密码</label>
			    <div class="controls">
			      <input type="password" id="old_password" name="old_password">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="password">新密码</label>
			    <div class="controls">
			      <input type="password" id="password"  name="password">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="re_password">重复密码</label>
			    <div class="controls">
			      <input type="password" id="re_password"  name="re_password">
			    </div>
		  	</div>

	    </div>
	    <div class="tab-pane" id="tab3">
			<div class="control-group">
			    <label class="control-label">当前头像：</label>
			    <div class="controls">
			      <img class="img-polaroid" src="<?php echo str_replace('_50', '_180', $user_model->avatar_file); ?>" alt="">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="avatar">重新上传</label>
			    <div class="controls">
			      <input type="file" id="avatar"  name="avatar">
			    </div>
		  	</div>

	    </div>
	  </div>
	<!-- end form -->
	<div class="control-group">
	    <div class="controls">
	    	<input type="submit" value="保存" class="btn btn-info" >
	    </div>
	</div>
	<?php 
		$this->endWidget();
	 ?>
	</div>

</div>