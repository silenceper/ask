<?php 
$this->pageTitle="首页";
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl .'/js/tag.js', CClientScript::POS_END);
?>
<!-- =====================左侧内容区 start-->
<div class="span9" id="ask_list">
	<ul class="nav nav-tabs">
    	<li class="pull-left">
        	<b style="line-height: 35px;"><i class="icon-question-sign"></i>全部问题</b>
        </li>
    	<li class="pull-right <?php if(isset($_GET['order']) && $_GET['order']=='unresponsive')echo 'active';?>">
        	<a href="?order=unresponsive">等待回复</a>
        </li>
        <li class="pull-right <?php if(isset($_GET['order']) && $_GET['order']=='hot')echo 'active';?>">
        	<a href="?order=hot">热门</a>
        </li>
        <li class="pull-right <?php if(!isset($_GET['order']) || (isset($_GET['order']) && $_GET['order']!='hot' && $_GET['order']!='unresponsive'))echo 'active';?>">
        	<a href="?order=new">最新</a>
        </li>
    </ul>
    <div class="ask_content">
    	<ul>
    		<?php 
    			//循环输出
    			foreach ($models as $model):
    		?>
        	<li>
            	<!-- 回复次数/查看次数 -->
            	<div class="replay_count pull-left text-center <?php if($model['answer_count']!='0')echo 'active'?>">
                	<span><?php echo $model['answer_count'];?></span>
                    <p>回复</p>
                </div>
                <!-- ask内容主体 -->
                <div class="ask_main pull-left span7">
                	<h5 id="ask_title">
                    	<a href="<?php echo $this->createUrl('question/index',array('id'=>$model['question_id']));?>">
                        	<?php echo $model['question_content'];?> 
                        </a>
                        &nbsp;
                        <?php if($model['lock']): ?>
                            <span style="font-style:normal;" title="该问题已锁定?" class="text-error">[该问题已锁定]</span>
                        <?php  endif; ?>
                     </h5>
                    <div id="ask_info">
                        <p class="span4 pull-left" style="margin-left:0">
                        <?php 
                        	if($topics=$this->getTopicByQuestionId($model['question_id'])):
                        ?>
                            <i class="icon-tags"></i>
                            <?php foreach ($topics as $topic):?>
                                <a href="<?php echo $this->createUrl('Topic/index',array('id'=>$topic['topic_id']))?>"><span class="label label-info"><?php echo $topic['topic_title']?></span></a>
                    		<?php endforeach;?>
                    	<?php endif;?>
                    	 </p>
                         <p class="pull-right" style="margin-right:10px;">
                         	浏览人次: <?php echo $model['view_count']?> 人
                         </p>
                    </div >
                </div>
                <!--  -->
                <div class="ask_user pull-right">
                	<a href="<?php echo $this->createUrl('user/index',array('uid'=>$model['uid']));?>">
                    	<img class="img-rounded" src="<?php echo $model['avatar_file'];?>" width="50px">
                    </a>
                </div>
                <div class="clearfix"></div>
            </li>
            <?php 
            	endforeach;
            ?>
        </ul>
    </div>
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
<!-- =====================左侧内容区 end|| 右侧内容区start-->
<div class="span3" id="sidebar">
	<div class="text-center">
    	<div class="sidebar_1 text-center">
        <?php if(Yii::app()->user->isGuest):?>
        	<a href="#loginModal" data-toggle="modal" class="btn btn-success">发起提问</a>
        <?php else:?>
        	<a href="<?php echo $this->createUrl('publish/create')?>" class="btn btn-success">发起提问</a>
        <?php endif;?>
        </div>
        <div class="sidebar_2">
        	<h5 class="text-left">热门话题</h5>
            <div id="tagsList">
                <?php foreach($topic_models as $topic_model): ?>
                <span>
                    <a href="<?php echo $this->createUrl('topic/index',array('id'=>$topic_model->id)) ?>">
                    <?php echo $topic_model->topic_title; ?>                    
                    </a>
                </span>
               <?php endforeach; ?>
            </div>
            <style type="text/css">
                #tagsList {position:relative; width:220px; height:300px; margin: -50px auto; }
                #tagsList a {position:absolute; top:0px; left:0px; font-family: Microsoft YaHei; color:#08c; font-weight:bold; text-decoration:none; padding: 3px 6px; }
                #tagsList a:hover { color:#FF0000; letter-spacing:2px;}     
            </style>
        </div>
    </div>
</div>
<!-- =====================右侧内容区结束-->
