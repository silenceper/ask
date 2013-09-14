<?php

/**
 * 处理问题评论与 回答评论
 * @author silenceper
 *
 */
class CommentController extends BaseController {

	//检查问题的评论
	public function actionCheckQuestion(){
		$transaction=Yii::app()->db->beginTransaction();
		try {
			$qc_models=new QuestionComments();
			$qc_models->message=$_POST['CommentForm']['message'];
			$qc_models->question_id=$_POST['CommentForm']['comment_id'];
			//查看该问题是否已经被锁定
			if($this->is_lock($qc_models->question_id)){
				throw new Exception("该问题已经被锁定！");
			}
			$qc_models->uid=Yii::app()->user->id;
			$qc_models->time=time();
			if(!$qc_models->save()){
				throw new Exception('评论失败');
			}
			//在question中的 comment_count字段+1
			if(!Question::model()->updateByPk($qc_models->question_id, array('comment_count'=>new CDbExpression('comment_count+1')))){
				throw new ErrorException('评论失败');
			}
			
			$transaction->commit();
			$this->redirect(Yii::app()->request->urlReferrer);
			//$this->success('评论成功');
		}catch(Exception $e){
			$transaction->rollBack();
			//exit($e->getMessage());
			$this->error($e->getMessage());
		}
	}
	
	//检查回答的评论
	public function actionCheckAnswer(){
		$transaction=Yii::app()->db->beginTransaction();
		try {
			$ac_models=new AnswerComments();
			$ac_models->message=$_POST['CommentForm']['message'];
			$ac_models->answer_id=$_POST['CommentForm']['comment_id'];
			$ac_models->uid=Yii::app()->user->id;
			$ac_models->time=time();
			if(!$ac_models->save()){
				throw new Exception('评论失败');
			}
			//在question中的 comment_count字段+1
			if(!Answer::model()->updateByPk($ac_models->answer_id, array('comment_count'=>new CDbExpression('comment_count+1')))){
				throw new ErrorException('评论失败');
			}
			
			$transaction->commit();
			$this->redirect(Yii::app()->request->urlReferrer);
			//$this->success('评论成功');
		}catch(Exception $e){
			$transaction->rollBack();
			//exit($e->getMessage());
			$this->error($e->getMessage());
		}
	}

}

?>