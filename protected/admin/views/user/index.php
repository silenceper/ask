<div class="condition alert alert-info">
	<?php $form = $this->beginWidget('CActiveForm', array(
	    'id'=>'condition-form',
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>true,
	    'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>
	搜索关键字:<input type="text" name="content"/>	
	<input type="submit" value="查询" class="btn btn-info">
	<span class="text-error">共有 <?php echo $count; ?>个用户</span>
	<?php $this->endWidget(); ?>

</div>
<div class="content">
	<table class="table table-condensed table-bordered">
		<thead>
			<tr>
				<th>UID</th>
				<th>用户名</th>
				<th>email</th>
				<th>性别</th>
				<th>注册时间</th>				
				<th>登入时间</th>	
				<th>提问数</th>
				<th>回答数</th>
				<th>操作</th>				
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($models as $model):
			 ?>
			<tr>
				<td>
					<?php echo $model['uid'] ?>
				</td>
				<td>
					<img src="<?php echo $model['avatar_file'] ?>" style="width:30px;">
					<?php echo $model['username'] ?>
				</td>	
				<td>
					<?php echo $model['email'] ?>
				</td>	
				<td>
					<?php echo $model['sex'] ?>
				</td>	
				<td>
					<abbr title="ip:<?php echo $model['reg_ip'] ?>"><?php echo date('Y-m-d H:i:s',$model['reg_time']); ?></abbr>
				</td>	
				<td>
					<abbr title="ip:<?php echo $model['last_ip'] ?>"><?php echo date('Y-m-d H:i:s',$model['last_login']); ?></abbr>
				</td>
				<td>
					<?php echo $this->getQuestionCount($model['uid']); ?>
				</td>	
				<td>
					<?php echo $this->getAnswerCount($model['uid']); ?>
				</td>
				<td>
					<a href="<?php echo $this->createUrl('update',array('uid'=>$model['uid'])) ?>">编辑</a> 
						&nbsp;/&nbsp;
					<a class="text-error" onclick="return confirm('您确认要删除吗? 删除之后将无法恢复！');" href="<?php echo $this->createUrl('delete',array('uid'=>$model['uid'])) ?>">删除</a>
				</td>			
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>