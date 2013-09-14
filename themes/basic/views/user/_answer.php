		<div class="user_bottom span11">
			<ul class="nav nav-tabs">
				<li><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'],'type'=>'self')) ?>">提问</a></li>
			    <li><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'],'type'=>'focus')); ?>">关注</a></li>
			    <li class="active"><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'],'type'=>'answer')) ; ?>">回答(<?php echo $count ?>)</a></li>
			</ul>
			<div class="tab-content">

			<div class="tab-pane active" id="focus">
			  	<!-- focus -->
				<ul style="list-style-type:square">
				<?php foreach($answer_models as $answer_model): ?>
				<li>
					<a href="<?php echo $this->createUrl('question/index',array('id'=>$answer_model['id'])); ?>" target="_blank">
						<?php echo $answer_model['question_content'] ?> 
					</a>
					<br/>
					<div class="muted info">
						回答数:
							<?php echo $answer_model['answer_count'] ?> 
						&nbsp;&nbsp;&nbsp;浏览数:
							<?php echo $answer_model['view_count'] ?> 
						&nbsp;&nbsp;&nbsp;提问时间:	
						<?php echo date('Y-m-d',$answer_model['add_time']); ?> 
						&nbsp;&nbsp;&nbsp;状态: 
						<?php 
							if($answer_model['lock']=='1'):
						 ?>
						<span class="text-error">
							已锁定
						</span>	
						<?php 
							elseif($answer_model['best_answer']):
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
			</div>
			</div>
		</div>