<?php 
	$this->pageTitle="{$question_model['question_content']}";
	Yii::app()->clientScript->registerScriptFile(yii::app()->theme->baseUrl.'/js/common.js');
?>
<div class="span9">
	<div id="header">
		<h4 class="title" style="border-bottom:1px dotted #c1cad4">
		<span class="text-error">[已锁定] </span>&nbsp;<?php echo $question_model['question_content']?>
		</h4>
	</div>
	<div class="detail">
		<div class="detail_content"><?php echo $question_model['question_detail']?></div>
		<div class="detail_info">
			发表于:<?php echo date('m-d H:i:s',$question_model['add_time'])?>
			<!-- 
				<span class="edit_btn">
					<a href=""><i class="icon-edit"></i>编辑</a>
				</span>
			 -->
		</div>
		<?php 
			if($question_comment_models):
		?>
		<!-- 问题评论 -->
		<div class="question_comment">
			<ul>
				<?php 
					foreach ($question_comment_models as $question_comment_model):
				?>
					<li>
						<blockquote  class="muted">
							<a href="<?php echo $this->createUrl('user/index',array('uid'=>$question_comment_model['uid']));?>" ><?php echo $question_comment_model['username']?> </a>:
							<?php echo $question_comment_model['message'];?> 
						</blockquote>
					</li>
				<?php 
					endforeach;
				?>
			</ul>
		</div>
		<?php endif;?>
		<div class="clearfix"></div>
	</div>
	<!-- 回复 -->
	<div class="answer">
		<!-- 发表回复 -->
		<div class="answer_count">
		<h4><?php echo count($answer_models)?>条回复</h4>
		</div>
		<!-- 回复列表 -->
		<div class="answer_content">
			<ul>
				<?php foreach ($answer_models as $answer_model):?>
				<li  class="<?php if($answer_model['id']==$question_model['best_answer']) echo 'best_answer';?>">
					<div class="pull-left">
						<a href="<?php echo $this->createUrl('user/index',array('uid'=>$answer_model['uid']))?>"><img src="<?php echo $answer_model['avatar_file'];?>" width="50px;"/></a>
					</div>
					<!--
					<div class="good_bad pull-left">
	            		<a href="javascript:;" class="good"></a>
	            		<em class="s"><?php echo $answer_model['agree_count']?></em>
	            		<a href="javascript:;" class="bad"></a>
					</div>
					-->
					<div class="answer_main pull-left span7">
						<a href="<?php echo $this->createUrl('user/index',array('uid'=>$answer_model['uid']))?>"><?php echo $answer_model['username']?></a>
						<p style="padding:10px 0;"><?php echo $answer_model['answer_content']?></p>
						<div class="tool">
							<span class="muted">回答于:<?php echo date('Y-m-d H:i:s',$answer_model['add_time'])?></span>
						</div>
						
					</div>
					<!-- answer 评论 -->
					<?php if($answer_comment_models=$this->getAnswerComment($answer_model['id'])):?>
					<!-- 问题评论 -->
					<div class="answer_comment pull-left ">
						<div style="margin-left:50px;">
							<strong>---共有 <?php echo count($answer_comment_models); ?> 条评论---</strong>
						</div>
						<ul>
							<?php foreach ($answer_comment_models as $answer_comment_model):?>
							<li>
								<blockquote  class="muted"><a href="<?php echo $this->createUrl('user/index',array('uid'=>$answer_comment_model['uid']))?>" ><?php echo $answer_comment_model['username']?> </a>: 
								<?php echo $answer_comment_model['message']?>
								</blockquote>
							</li>
							<?php endforeach;?>
						</ul>
					</div>
					<?php endif;?>
					<div class="clearfix"></div>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="answer_input">
			<!-- 未登入用户 -->
			<p class="text-center">
				该问题已锁定，无法继续回复！		
			</p>
		</div>
	</div>
</div>
<div class="span3" id="sidebar">
	<div class="sidebar_1" style="padding-top:0px;">
		<a href="<?php echo $this->createUrl('user/index',array('uid'=>$question_model['uid'])) ?>">
			<img class="img-polaroid" src="<?php echo str_replace('_50', '_180', $question_model['avatar_file']);?>" style="width:120px"/><br/>
			<?php echo $question_model['username']?>
		</a>
		<br/>
		<?php 
			$topics=$this->getTopicByQuestionId($question_model['id']);
		?>
		<?php if($topics):?>
			<h5>提到的话题:</h5>
			<div class="topics">
				<?php foreach ($topics as $topic):?>
					<a href='<?php echo $this->createUrl('topic/index',array('id'=>$topic['topic_id']));?>' class="label label-info"><?php echo $topic['topic_title']?></a>
				<?php endforeach;?>
			</div>
		<?php endif;?>
	</div>
	<div class="sidebar_2" style="padding-top:0px;">
		<h4>问题状态</h4>
		<p class="text-success">
			浏览次数:<?php echo $question_model['view_count']?><br/>
			回答次数:<?php echo $question_model['answer_count']?><br/>
			关注次数:<?php echo $question_model['focus_count']?>
		</p>
	</div>
</div>
