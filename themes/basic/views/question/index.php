<?php 
	$this->pageTitle="{$question_model['question_content']}";
	Yii::app()->clientScript->registerScriptFile(yii::app()->theme->baseUrl.'/js/common.js');
?>
<div class="span9">
	<div id="header">
		<h4 class="title" style="border-bottom:1px dotted #c1cad4"><?php echo $question_model['question_content']?>
			<?php if(!Yii::app()->user->isGuest):?>
				<?php 
					if($question_model['is_focus']):
				?>	
					<a href="javascript:q_focus(<?php echo $question_model['id']?>);" class="btn  btn-info btn-mini pull-right btn-inverse" id="focus_btn">取消关注</a>
				<?php else:?>
					<a href="javascript:q_focus(<?php echo $question_model['id']?>);" class="btn btn-info btn-mini pull-right" id="focus_btn">关注</a>
				<?php endif;?>
			<?php endif;?>
		</h4>
	</div>
	<div class="detail">
		<div class="detail_content"><?php echo $question_model['question_detail']?></div>
		<div class="detail_info">
			<?php echo date('m-d H:i:s',$question_model['add_time'])?>
			 <?php if($this->checkUpdateAuth($question_model['id'])): ?>
				<span class="edit_btn">
					<a href="<?php echo $this->createUrl('publish/update',array('id'=>$question_model['id'])) ?>">编辑</a>
				</span>
			<?php endif; ?>
			<?php if(!Yii::app()->user->isGuest):?>
				<a href="javascript:;" onclick="add_comment('<?php echo $this->createUrl('comment/checkquestion')?>','添加评论','',<?php echo  $question_model['id']?>);" class="text-info">添加评论</a>
			<?php endif;?>
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
							<?php if(!Yii::app()->user->isGuest):?>
								&nbsp;&nbsp; <a href="javascript:;" onclick="add_comment('<?php echo $this->createUrl('comment/checkquestion')?>','回复<?php echo $question_comment_model['username'];?>','@<?php echo $question_comment_model['username'];?>',<?php echo  $question_model['id']?>);" class="question_reply_btn hide">回复</a>
							<?php endif;?>
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
			<h4><?php echo count($answer_models); ?>条回答</h4>
		</div>
		<!-- 回复列表 -->
		<div class="answer_content">
			<ul>
				<?php foreach ($answer_models as $answer_model):?>
				<li>
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
						<span style="font-size:12px;" class="muted">回答于:<?php echo date('Y-m-d H:i:s',$answer_model['add_time'])?></span>
						<p style="padding:10px 0;"><?php echo $answer_model['answer_content']?></p>
						<div class="tool">
							<?php if(!Yii::app()->user->isGuest): ?>
								<a href="javascript:;" onclick="add_comment('<?php echo $this->createUrl('comment/checkanswer')?>','添加评论','',<?php echo  $answer_model['id']?>);">评论</a>
							<?php endif; ?>
							<?php 
								/* 如果为当前登入用户 为问题的发起者则显示最佳答案按钮 */
								if(isset(Yii::app()->user->id) && Yii::app()->user->id==$question_model['uid']):
							?>
							<!--
								&nbsp;|&nbsp; 
							<a href="">有帮助</a>
							&nbsp;|&nbsp; 
							<a href="">没帮助</a>
							-->
							&nbsp;|&nbsp; 
							<a href="<?php echo $this->createUrl('question/setbest',array('answer_id'=>$answer_model['id'],'question_id'=>$question_model['id']));?>" id="best_answer_btn">最佳答案</a>
							<?php endif;?>
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
								<?php if(!Yii::app()->user->isGuest):?>
								&nbsp;&nbsp; <a href="javascript:;" onclick="add_comment('<?php echo $this->createUrl('comment/checkanswer')?>','回复','@<?php echo $answer_comment_model['username']?> ',<?php echo  $answer_model['id']?>);"  class="answer_reply_btn hide">回复</a>
								<?php endif;?>
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
			<?php if(Yii::app()->user->isGuest):?>
			<!-- 未登入用户 -->
			<p class="text-center">要回复问题请先<a href="#loginModal" data-toggle="modal">登入</a>或<a href="<?php echo $this->createUrl('site/register')?>">注册</a></p>
			<?php else:?>
			<!-- answer form start -->
			<?php $form=$this->beginWidget('CActiveForm', array(
			    	'action'=>$this->createUrl('Answer/checkanswer'),
					'id'=>'answer-form',
					'enableClientValidation'=>true,
		    		'enableAjaxValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); 
				$model=new AnswerForm();
			?>
			<?php echo $form->error($model,'answer_content'); ?>
			<?php echo $form->textArea($model,'answer_content',array('class'=>'span8'));?>
			<div class="pull-left">
				<a href="<?php echo $this->createUrl('user/index',array('uid'=>Yii::app()->user->id));?>">
					<img class="img-rounded"  src="<?php echo Yii::app()->user->getState('userInfo')->avatar_file;?>" width="50px"/>&nbsp;&nbsp; <?php echo Yii::app()->user->getState('userInfo')->username;?>
				</a>
			</div>
			<div class="pull-right answer-submit">
				<!-- hidden input -->
				<?php echo $form->hiddenField($model,'question_id',array('value'=>$question_model['id']))?>
				<input type="submit" class="btn btn-info span2" value="提交回答"/>
			</div>
			<div class="clearfix"></div>
			
			<?php $this->endWidget();?>
			<!-- end form -->
			<?php endif;?>
		</div>
	</div>
</div>
<div class="span3" id="sidebar">
	<div class="sidebar_1" style="padding-top:0px;">
		<a href="<?php echo $this->createUrl('user/index',array('uid'=>$question_model['uid'])) ?>">
			<img class="img-polaroid" src="<?php echo str_replace('_50', '_180', $question_model['avatar_file']);?>"  style="width:120px"/><br/>
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
<!-- Comment Modal弹出登入层 -->
<div id="commentModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h6 id="comment_title">添加评论</h6>
  </div>
  <div class="modal-body comment_reply">
  <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'comment-form',
			'enableClientValidation'=>true,
    		'enableAjaxValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); 
		$model=new CommentForm();
	?>
  	<?php echo $form->textArea($model,'message',array('id'=>'comment_message'));?>
  	<?php echo $form->hiddenField($model,'comment_id',array('id'=>'comment_id'));?>
  	<input type="submit" class="btn btn-primary pull-right"/>
  <?php 
  	$this->endWidget();
  ?>
  </div>
</div>
<script type="text/javascript">
	function q_focus(id){
		//ajax 提交
		$.post('<?php echo $this->createUrl('question/dofocus');?>',{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},function(data){
			//解析json
			var data=eval("("+data+")");
			if(data.status){
				if(data.mesg=='关注成功'){
					$('#focus_btn').addClass('btn-inverse');
					$('#focus_btn').text('取消关注');
				}else{
					$('#focus_btn').removeClass('btn-inverse');
					$('#focus_btn').text('关注');
				}
			}else{
				alert(data.mesg);
			}
		});
	}
	$(function(){
		$('.question_comment>ul>li').hover(function(){
			//显示
			$(this).find('.question_reply_btn').show();
		},function(){
			//隐藏
			$(this).find('.question_reply_btn').hide();
		});
		$('.answer_comment>ul>li').hover(function(){
			//显示
			$(this).find('.answer_reply_btn').show();
		},function(){
			//隐藏
			$(this).find('.answer_reply_btn').hide();
		})
	})
</script>
