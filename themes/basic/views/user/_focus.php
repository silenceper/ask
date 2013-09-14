		<div class="user_bottom span11">
			<ul class="nav nav-tabs">
				<li><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'])) ?>&type=self">提问</a></li>
			    <li  class="active"><a href="javascript:;">关注(<?php echo $count ?>)</a></li>
			    <li><a href="<?php echo $this->createUrl('user/index',array('uid'=>$_GET['uid'])) ; ?>&type=answer">回答</a></li>
			</ul>
			<div class="tab-content">

			<div class="tab-pane active" id="focus">
			  	<!-- focus -->
				<ul style="list-style-type:square">
				<?php foreach($focus_models as $focus_model): ?>
				<li>
					<a href="<?php echo $this->createUrl('question/index',array('id'=>$focus_model['id'])) ?>" target="_blank">
						<?php echo $focus_model['question_content'] ?> 
					</a>
					<br/>
					<div class="muted info">
						回答数:
							<?php echo $focus_model['answer_count'] ?> 
						&nbsp;&nbsp;&nbsp;浏览数:
							<?php echo $focus_model['view_count'] ?> 
						&nbsp;&nbsp;&nbsp;提问时间:
						<?php echo date('Y-m-d',$focus_model['add_time']); ?> 
						&nbsp;&nbsp;&nbsp;状态: 
						<?php 
							if($focus_model['lock']=='1'):
						 ?>
						<span class="text-error">
							已锁定
						</span>	
						<?php 
							elseif($focus_model['best_answer']):
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