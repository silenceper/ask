<div class="condition alert alert-info">
	<?php $form = $this->beginWidget('CActiveForm', array(
	    'id'=>'condition-form',
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>true,
	    'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>
	搜索关键字:<input type="text" name="content"/>	
	<input type="submit" value="查询" class="btn btn-info">
	<span class="text-error">共有 <?php echo $count; ?>个问题</span>
	<?php $this->endWidget(); ?>

</div>
<!-- 显示列表 -->
<div class="content">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>标题</th>
				<th>作者</th>
				<th>时间</th>
				<th>回复数</th>
				<th>关注数</th>
				<th>评论数</th>
				<th>浏览数</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($models as $model):?>
			<?php 
				$status='';
				if($model['best_answer']){
					$status='success';
				}elseif($model['lock']){
					$status='error';
				}
			 ?>

			<tr class="<?php echo $status; ?>">
				<td><?php echo $model['id']?></td>		
				<td><a href="/question/index?id=<?php echo $model['id'] ?>" target="_blank"><?php echo $model['question_content']?></a></td>		
				<td><a href="
					<?php echo $this->createUrl('question/index',array('uid'=>$model['uid'])); ?>"><?php echo $model['username']?></a></td>	
				<td><?php echo date('Y-m-d H:i:s',$model['add_time'])?></td>		
				<td><?php echo $model['answer_count']?></td>		
				<td><?php echo $model['focus_count']?></td>		
				<td><?php echo $model['comment_count']?></td>		
				<td><?php echo $model['view_count']?></td>	
				<td><?php  echo ($model['lock']==1) ?  '<span class="text-error">锁定</span>': '正常';?></td>		
				<td>
					<a href="<?php echo $this->createUrl('question/update',array('id'=>$model['id'])); ?>">编辑</a> &nbsp; / &nbsp;
					<a href="<?php echo $this->createUrl('question/delete',array('id'=>$model['id'])); ?>" class="text-error" onclick="return confirm('您确认要删除吗，删除之后将无法恢复?')">删除</a> 
				</td>
			</tr>
		<?php endforeach;?>
			<tr>
			<td colspan="10" style="text-align:center;">
				<?php 
                  //分页
                  $this->widget('CLinkPager', array(
						 'header'=>'',
						 'pages' => $pages,
					));
		 		 ?>
		 	</td>
			</tr>
		</tbody>
	</table>
</div>