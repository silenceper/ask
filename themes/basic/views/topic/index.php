<?php 
	$this->pageTitle="包含话题“{$question_models[0]['topic_title']}”的问题";
?>
<div class="span9">
	<div id="header">
		<h4 class="">包含话题"<?php echo $question_models[0]['topic_title'] ?>"的提问<span class="pull-right muted"><?php echo $count;?>条记录</span></h4>
	</div>
	<div id="search_content">
		<!-- 循环内容 -->
		<ul>
			<?php 
				foreach($question_models as $question_model):
			?>
			<li class="item">
				<p>
					<?php if($question_model['best_answer']): ?>
                        <span title="该问题已解决?" class="text-success">[已解决]</span>
                    <?php elseif($question_model['lock']): ?>
                        <span title="该问题已锁定?" class="text-error">[已锁定]</span>
                    <?php  endif; ?>
					<a target="_blank" href="<?php echo $this->createUrl('question/index',array('id'=>$question_model['id']));?>">
						<?php 
							echo  $question_model['question_content'];
						?>
					</a>
				</p>
				<div class="muted">
					<?php echo $question_model['answer_count'];?>个回复 • <?php echo $question_model['view_count'];?>次浏览 
				</div>
			</li>
			<?php 
				endforeach;
			?>
		</ul>
		<div class="pages pull-right">
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
<div class="span3">
	
</div>