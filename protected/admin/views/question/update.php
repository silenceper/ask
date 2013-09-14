<?php 
	$this->pageTitle="更新";	
	$form=$this->beginWidget('CActiveForm',array(
				'action'=>$this->createUrl('question/checkupdate'),
				'id'=>'update-form',
			));
?>
<div class="content">
	<table class="table table-striped table-bordered" id="update">
		<tr>
			<th class="text-right">标题：</th>
			<td>
				<input type="text" name="question_content" value="<?php echo $model['question_content'] ?>" />
				<?php if($model['best_answer']): ?>
					<span class="label label-success">已解决</span>
				<?php endif; ?>
				<?php if($model['lock']): ?>
					<span class="label label-important">已锁定</span>
				<?php endif; ?>
			</td>		
		</tr>
		<tr>
			<th class="text-right">作者：</th>
			<td><a target="_blank" href="/question/index?id=<?php echo $model['id'] ?>" ><?php echo $model['username'] ?></a></td>		
		</tr>
		<tr>
			<th class="text-right">详细：</th>
			<td><textarea name="question_detail"><?php echo  $model['question_detail'] ;?></textarea></td>		
		</tr>
		<tr>
			<th>锁定</th>
			<td>
				<select name='lock'>
					<option value="0" <?php if($model['lock']==0)echo 'selected' ?> >正常</option>
					<option value="1" <?php if($model['lock']==1)echo 'selected' ?> >锁定</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>状态:</th>
			<td id="status">
				<span class="label label-info"><?php echo $model['view_count'] ?>人查看</span>
				<span class="label label-info"><?php echo $model['focus_count'] ?>人关注</span>
				<span class="label label-info"><?php echo $model['answer_count'] ?>人回答</span>
				<span class="label label-info"><?php echo $model['comment_count'] ?>人评论</span>
			</td>
		</tr>
		<tr>
			<th>时间:</th>
			<td>
				<p>发布时间:<?php echo date('Y-m-d H:i:s',$model['add_time']); ?></p>
				<p>最后更新时间:<?php echo date('Y-m-d H:i:s',$model['update_time']); ?></p>	
			</td>
		</tr>
		<tr>	
			<td></td>
			<td>
				<input type="hidden" name="id" value="<?php echo $model['id'] ?>">
				<input type="submit" value="保存" class="btn btn-primary">
				<a href="javascript:window.history.back(-1)" class="btn">返回</a>
			</td>
		</tr>
	</table>
	<?php 
		$this->endWidget();
	 ?>
</div>	