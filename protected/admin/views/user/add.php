<?php 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/public/plugin/calendar/calendar.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/public/plugin/calendar/calendar-blue.css');
?>
<div class="content">
<?php 
	$this->beginWidget('CActiveForm',array(
				'action'=>$this->createUrl('checkadd'),
				'id'=>'add-form',
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
			));
 ?>
	<table class="table table-bordered" id="update">
		<tbody>
			<tr>
				<th>用户名</th>
				<td>
					<input type="text"  name="username"> 				
				</td>			
			</tr>
			<tr>
				<th>email</th>
				<td>
					<input type="text" name="email"> 			
				</td>			
			</tr>
			<tr>
				<th>性别</th>
				<td>
					<select name="sex">
						<option value="male" >男</option>
						<option value="female" >女</option>								
					</select>		
				</td>			
			</tr>
			<tr>
				<th>生日</th>
				<td>
                    <input  name="birthday"  id="birthday" size="16" type="text" autocomplete="off">
				</td>			
			</tr>
			<tr>
				<th>手机号</th>
				<td>
                    	<input type="text" name="mobile">
				</td>			
			</tr>
			<tr>
				<th>密码</th>
				<td>
					<input name="password" type="password" >					
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input type="submit" value="添加" class="btn btn-primary">
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