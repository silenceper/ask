<?php 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/public/plugin/calendar/calendar.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerCssFile('/public/plugin/calendar/calendar-blue.css');
?>
<div class="content">
<?php 
	$this->beginWidget('CActiveForm',array(
				'action'=>$this->createUrl('checkupdate'),
				'id'=>'update-form',
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
			));
 ?>
	<table class="table table-bordered" id="update">
		<tbody>
			<tr>
				<th width="100px;">UID</th>
				<td>
					<input type="text" name="uid" value="<?php echo $model->uid; ?>" readonly>					
				</td>			
			</tr>
			<tr>
				<th>用户名</th>
				<td>
					<input type="text" value="<?php echo $model->username; ?>" name="username"> 				
				</td>			
			</tr>
			<tr>
				<th>头像</th>
				<td>
					<img src="<?php echo $model['avatar_file'] ?>" style="height:50px;width:50px;">
					<br/>
					<input type="file" name="avatar" class="file">
				</td>
			</tr>
			<tr>
				<th>email</th>
				<td>
					<input type="text" value="<?php echo $model->email; ?>" name="email"> 			
				</td>			
			</tr>
			<tr>
				<th>性别</th>
				<td>
					<select name="sex">
						<option value="" selected="true"></option>
						<option value="male" <?php if($model->sex=='male') echo 'selected';?>>男</option>
						<option value="female" <?php if($model->sex=='female') echo 'selected'?>>女</option>								
					</select>		
				</td>			
			</tr>
			<tr>
				<th>生日</th>
				<td>
                    <input name="birthday" id="birthday" size="16" type="text" value="<?php echo date('Y-m-d',$model->birthday); ?>" >
				</td>			
			</tr>
			<tr>
				<th>手机号</th>
				<td>
                    	<input type="text" value="<?php echo $model['mobile'] ?>" name="mobile">
				</td>			
			</tr>
			<tr>
				<th>密码</th>
				<td>
					<input data-toggle="tooltip" data-placement="right" name="password"  data-original-title="不修改请留空" type="password" >					
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input type="submit" value="修改" class="btn btn-primary">
					<input onclick="javascript:window.history.back(-1)" type="button" value="返回" class="btn">
				</td>
			</tr>
		</tbody>
	</table>
	<?php 
		$this->endWidget();
	 ?>
</div>
<script type="text/javascript">
	$(function(){
		$('input[data-toggle="tooltip"]').tooltip();
		//日期插件
		Calendar.setup({
           inputField     :    "birthday",
		   ifFormat       :    "%Y-%m-%d",
		   showsTime      :    'false',
		   timeFormat     :    "24"
        });
	})
</script>