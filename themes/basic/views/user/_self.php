		<div class="user_bottom span11">
			<ul class="nav nav-tabs">
				<li class="active"><a href="javascript:;">提问 (<?php echo $count ?>)</a></li>
			    <li><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'])); ?>&type=focus">关注</a></li>
			    <li><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'])) ; ?>&type=answer">回答</a></li>
			</ul>
			<div class="tab-content">

			<div class="tab-pane active" id="focus">
			  	<!-- focus -->
				<ul style="list-style-type:square">
				<?php foreach($models as $model): ?>
				<li>
					<a href="<?php echo $this->createUrl('question/index',array('id'=>$model['id'])) ?>" target="_blank">
						<?php echo $model['question_content'] ?> 
					</a>
					<br/>
					<div class="muted info">
						回答数:
							<?php echo $model['answer_count'] ?> 
						&nbsp;&nbsp;&nbsp;浏览数:
							<?php echo $model['view_count'] ?> 
						&nbsp;&nbsp;&nbsp;提问时间:
						<?php echo date('Y-m-d',$model['add_time']); ?> 
						&nbsp;&nbsp;&nbsp;状态: 
						<?php 
							if($model['lock']=='1'):
						 ?>
						<span class="text-error">
							已锁定
						</span>	
						<?php 
							elseif($model['best_answer']):
						 ?>
						<span class="text-success">
							已解决
						</span>	
						<?php 
							else:
						 ?>
						<span class="text-info">
							未解决
						</span>
						<?php 
							endif;
						 ?>	
					
					</div>
				</li>
				<?php endforeach; ?>
				</ul>
				<div class="pages">
					<?php 
			          //分页
			           $this->widget('CLinkPager', array(
								 'header'=>'',
								 'pages' => $pages,
						));
			  		 ?>
				</div>
			</div>
			</div>
		</div>