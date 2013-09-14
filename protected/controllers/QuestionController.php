<?php

/**
 * 显示问题
 * @author silenceper
 *
 */
class QuestionController extends Controller {
	//问题页
	public function actionIndex($id){
		//检查是否存在此问题
		if(!Question::model()->exists('id=:id',array(':id'=>$id))){
			$this->error('此问题不存在',Yii::app()->homeUrl);
		}
		
		if(!Yii::app()->user->isGuest){
			//此问题的浏览人次加1
			$this->incViewCount($id);		
		}
		//获取问题相关信息
		$connection=Yii::app()->db;
		$sql="select `{{question}}`.`id`,`{{question}}`.`question_content`,`{{question}}`.`question_detail`,`{{question}}`.`add_time`,`{{question}}`.`update_time`,`{{question}}`.`view_count`,`{{question}}`.`answer_count`
				,`{{question}}`.`focus_count`,`{{question}}`.`comment_count`,`{{question}}`.`best_answer`,`{{question}}`.`lock`,`{{users}}`.`uid`,`{{users}}`.`username`,`{{users}}`.`avatar_file`
				from `{{question}}`
				left join `{{users}}` on (`{{question}}`.`published_uid` = `{{users}}`.`uid`) where  `{{question}}`.`id`=:id ";
		
		$question_model=$connection->createCommand($sql)->queryRow(true,array(':id'=>$id));
		//问题是否被该登入用户关注
		if(!Yii::app()->user->isGuest){
			if(QuestionFocus::model()->exists('uid=:uid AND question_id=:question_id',array(':uid'=>Yii::app()->user->id,':question_id'=>$id))){
				$question_model['is_focus']=true;
			}else {
				$question_model['is_focus']=false;
			}
		}
		
		//获取问题评论  并返回model
		$question_comment_models=$this->getQuestionComment($id);
		
		//获取答案相关信息
		$sql="select `{{answer}}`.`id`,`{{answer}}`.`answer_content`,`{{answer}}`.`add_time`,`{{answer}}`.`against_count`,`{{answer}}`.`agree_count`,`{{answer}}`.`comment_count`
				,`{{answer}}`.`ip`,`{{users}}`.`uid`,`{{users}}`.`username`,`{{users}}`.`avatar_file`
				from `{{answer}}`
				left join `{{users}}` on (`{{answer}}`.`uid` = `{{users}}`.`uid`) where  `{{answer}}`.`question_id`=:id ";
		$answer_models=$connection->createCommand($sql)->queryAll(true,array(':id'=>$id));
		//var_dump($answer_models);
		//exit();
		//var_dump($answer_models);
		//exit();
		


		if($question_model['best_answer']){
			//将数组进行排序，将最佳的一个答案放在第一位
			foreach($answer_models as $k=>$answer_model){
				if($answer_model['id']==$question_model['best_answer']){
					array_push($answer_models,$answer_model);
					unset($answer_models[$k]);
					$answer_models=array_reverse($answer_models);
					break;
				}
				
			}
			
			
			$this->render('index_ok',array(
					'question_model'=>$question_model,
					'answer_models'=>$answer_models,
					'question_comment_models'=>$question_comment_models,
			));
		}else if($question_model['lock']){
			//问题已经被锁定
			$this->render('index_lock',array(
					'question_model'=>$question_model,
					'answer_models'=>$answer_models,
					'question_comment_models'=>$question_comment_models,
			));

		}else{
			$this->render('index',array(
					'question_model'=>$question_model,
					'answer_models'=>$answer_models,
					'question_comment_models'=>$question_comment_models,
			));
		}
		
	}
	
	/**
	 * 获取问题的评论
	 * return model
	 */
	private function getQuestionComment($question_id){
		$connection=Yii::app()->db;
		$sql="select `{{question_comments}}`.`question_id`,`{{question_comments}}`.`message`,`{{question_comments}}`.`time`,`{{users}}`.`uid`,`{{users}}`.`username`
				from `{{question_comments}}` left join `{{users}}` on (`{{question_comments}}`.`uid` = `{{users}}`.`uid`) where `{{question_comments}}`.`question_id`=:question_id order by `{{question_comments}}`.`time` asc";
		return  $connection->createCommand($sql)->queryAll(true,array(':question_id'=>$question_id));
	}
	
	/**
	 * 获取问题的评论
	 * return model
	 */
	public function getAnswerComment($answer_id){
		$connection=Yii::app()->db;
		$sql="select `{{answer_comments}}`.`answer_id`,`{{answer_comments}}`.`message`,`{{answer_comments}}`.`time`,`{{users}}`.`uid`,`{{users}}`.`username`
				from `{{answer_comments}}` left join `{{users}}` on (`{{answer_comments}}`.`uid` = `{{users}}`.`uid`) where `{{answer_comments}}`.`answer_id`=:answer_id order by `{{answer_comments}}`.`time` asc";
		return  $connection->createCommand($sql)->queryAll(true,array(':answer_id'=>$answer_id));
	}
	
	/**
	 * 查看人数+1
	 * @param int $id
	 * 只有登入用户才+1
	 */
	private function incViewCount($id){
		if(!Question::model()->updateByPk($id, array('view_count'=>new CDbExpression('view_count+1')))){
			//throw new ErrorException('评论失败');
		}
	}
	/**
	 * focus人数+1
	 * @param int $id
	 * 只有登入用户才+1
	 */
	private function incFocusCount($id){
		if(!Question::model()->updateByPk($id, array('focus_count'=>new CDbExpression('focus_count+1')))){
			throw new ErrorException('评论失败');
		}
	}
	
	/**
	 * focus人数-1
	 * @param int $id
	 * 只有登入用户才+1
	 */
	private function DecFocusCount($id){
		if(!Question::model()->updateByPk($id, array('focus_count'=>new CDbExpression('focus_count-1')))){
			throw new ErrorException('评论失败');
		}
	}
	
	
	public function actionDoFocus(){
		if(!Yii::app()->request->isAjaxRequest){
			$this->error('非法请求');
		}
		$id=$_POST['id'];
		//首先查找问题是否存在
		if(QuestionFocus::model()->exists('uid=:uid AND question_id=:question_id',array(':uid'=>Yii::app()->user->id,':question_id'=>$id))){
			$is_focus=true;
		}else {
			$is_focus=false;
		}
		$data=array();
		if(!$is_focus){
			$transaction=Yii::app()->db->beginTransaction();
			try {
				//执行插入
				$qf_model=new QuestionFocus();
				$qf_model->question_id=$id;
				$qf_model->uid=Yii::app()->user->id;
				$qf_model->add_time=time();
				if(!$qf_model->save()){
					throw new ErrorException('关注失败');
				}
				$this->incFocusCount($id);
				$transaction->commit();
				$data['mesg']='关注成功';
				$data['status']=true;
			}catch(Exception $e){
				$transaction->rollBack();
				$data['mesg']='关注失败';
				$data['status']=false;
			}
		//取消关注
		}else{
			$transaction=Yii::app()->db->beginTransaction();
			try {
				//执行取消插入
				if(!QuestionFocus::model()->deleteAll('question_id=:question_id AND uid=:uid',array(':question_id'=>$id,':uid'=>Yii::app()->user->id))){
					throw new Exception('取消关注失败');
				}
				$this->DecFocusCount($id);
				$transaction->commit();
				$data['mesg']='取消关注成功';
				$data['status']=true;
			}catch(Exception $e){
				$transaction->rollBack();
				$data['mesg']='取消关注失败';
				$data['status']=false;
			}
			
		}
		
		echo json_encode($data);
	}

	/*
	 *
	 *设置为最佳答案
	 *
	 */
	public function actionSetBest($question_id,$answer_id){
		if(Question::model()->updateByPk($question_id,array('best_answer'=>$answer_id))){
			$this->redirect(Yii::app()->request->urlReferrer);
		}
	}	
}

?>
