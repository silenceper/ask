<?php

class AnswerController extends Controller {
	
	/**
	 * 验证回答
	 */
	public function actionCheckAnswer(){
		//登入判断
		$this->checkAuth();
		$model=new AnswerForm();
		if(isset($_POST['ajax']) && $_POST['ajax']==='answer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	
		//var_dump($_POST['AnswerForm']);
		//启用事物处理 因为需要插入 Answer表及Question字段中的answer_count 字段
		$transaction=Yii::app()->db->beginTransaction();
		try {
			$answer_model=new Answer();
			$answer_model->answer_content=$_POST['AnswerForm']['answer_content'];
			$answer_model->question_id=$_POST['AnswerForm']['question_id'];
			$answer_model->uid=Yii::app()->user->id;
			$answer_model->add_time=time();
			$answer_model->ip=Yii::app()->request->userHostAddress;
			if(!$answer_model->save()){
				throw new ErrorException('回答失败1');
			}
				
			//更改question表中的answer_count 信息
			if(!Question::model()->updateByPk($answer_model->question_id, array('answer_count'=>new CDbExpression('answer_count+1')))){
				throw new ErrorException('回答失败2');
			}
				
			$transaction->commit();
			$this->redirect(Yii::app()->request->urlReferrer );
			//$this->success('回答成功');
		}catch(Exception $e){
			$transaction->rollBack();
			//exit($e->getMessage());
			$this->error($e->getMessage());
		}
	
	}
}

?>