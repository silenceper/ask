<?php
/**
 * 管理问题
 * @author silenceper
 *
 */
class QuestionController extends BaseController {
	/**
	 * 显示问题列表
	 */
	public function actionIndex(){


		$sql="select `{{question}}`.`id`,`{{question}}`.`question_content`,`{{question}}`.`add_time`,`{{question}}`.`update_time`,`{{question}}`.`answer_count`,`{{question}}`.`view_count`,`{{question}}`.`lock`,`{{question}}`.`focus_count`,`{{question}}`.`comment_count`,`{{question}}`.`best_answer`,`{{question}}`.`ip`,`{{users}}`.`username`,`{{users}}`.`uid`
				from `{{question}}`				
				left join `{{users}}` on (`{{users}}`.`uid` = `{{question}}`.`published_uid`)";

		$condition=array();
		//根据uid搜索
		if(isset($_GET['uid'])){
			$condition[]="`{{users}}`.`uid`={$_GET['uid']} ";
		}

		if(isset($_POST['content'])){
			$condition[]=" `{{question}}`.`question_content` like '%{$_POST['content']}%'";
		}

		$conditions=implode('AND', $condition);
		//var_dump($conditions);
		if($conditions){
			$conditions=' where '.$conditions;
			$sql.=$conditions;
		}
		$sql.=" order by `{{question}}`.`add_time` desc ";
		$connection=Yii::app()->db;
		$criteria = new CDbCriteria;
		$models=$connection->createCommand($sql)->queryAll();
		$count=count($models);
		$pages = new CPagination($count);
		$pages->pageSize = 12;
		$pages->applylimit($criteria);
		$models=$connection->createCommand($sql." LIMIT :offset,:limit");
		$models->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$models->bindValue(':limit', $pages->pageSize);
		$models=$models->queryAll();
		$this->render('index',array(
				'models'=>$models,
				'pages'=>$pages,
				'count'=>$count,
		));
	}
	
	
	/**
	 * 
	 * 更新question中的信息
	 *
	 */
	public function actionUpdate($id){
		$sql="select `{{question}}`.`id`,`{{question}}`.`question_content`,`{{question}}`.`question_detail`,`{{question}}`.`add_time`,`{{question}}`.`update_time`,`{{question}}`.`published_uid`,`{{question}}`.`answer_count`,`{{question}}`.`view_count`,`{{question}}`.`focus_count`,`{{question}}`.`comment_count`,`{{question}}`.`best_answer`,`{{question}}`.`lock`,`{{question}}`.`ip`,`{{users}}`.`username` from `{{question}}` left join `{{users}}` on (`{{users}}`.`uid`=`{{question}}`.`published_uid`) where `{{question}}`.`id`=:id";
		$model=Yii::app()->db->createCommand($sql)->queryRow(true,array(':id'=>$id));
		$this->render('update',array(
				'model'=>$model,
			));
	}

	/**
	 *
	 * 处理更新 
	 *
	 */
	public function actionCheckUpdate(){
		if (!isset($_POST)) {
			$this->error('错误的访问方式');
		}

		//开始处理提交信息
		//var_dump($_POST);
		$m=Question::model()->updateByPk($_POST['id'],array(
			'question_content'=>htmlspecialchars($_POST['question_content']),
			'question_detail'=>htmlspecialchars($_POST['question_detail']),
			'lock'=>$_POST['lock'],
			'update_time'=>time(),
			));
		if(false!==$m){
			$this->error('更新成功');
		}

	}


	/**
	 * 删除信息
	 * 多表删除  事物处理
	 * 删除 question 中信息
	 * 删除 answer 表中信息
	 * 删除 question 
	 * 更新topic中次数
	 */
	public function actionDelete($id){		
		$transaction=Yii::app()->db->beginTransaction();
		try {
			
			//删除question 表信息
			if(!Question::model()->deleteByPk($id)){
				throw new Exception("删除question表失败");
			}

			//删除 topic_question 表 首先把 topic  id 查找出来
			//获取topic id
			$topic_ids=TopicQuestion::model()->findAll(array(
					'select'=>'topic_id',
					'condition'=>'question_id=:question_id',
					'params'=>array(':question_id'=>$id),
				));

			//更新 topic次数
			foreach ($topic_ids as $model) {
				//更新topic 次数
				if(!Topic::model()->updateByPk($model->topic_id, array('discuss_count'=>new CDbExpression('discuss_count-1')))){
					throw new ErrorException('更新失败');
				}
			}

			//删除topic_question 表中信息
			if(false === TopicQuestion::model()->deleteAll('question_id=:question_id',array('question_id'=>$id))){
				throw new ErrorException('删除topic_question中信息失败');
			}

			//删除question_comment 中信息
			if(false === QuestionComments::model()->deleteAll('question_id=:question_id',array('question_id'=>$id))){
				throw new ErrorException('删除question_comment中信息失败');
			}

			//获取answer_comment 中id
			$answer_comment_models=Answer::model()->findAll(array(
					'select'=>'id',
					'condition'=>'question_id=:question_id',
					'params'=>array(
						':question_id'=>$id,
						),
				));

			//删除answer_comment 中信息
			foreach ($answer_comment_models as $answer_comment_model) {
				if(false === AnswerComments::model()->deleteAll('answer_id=:answer_id',array(':answer_id'=>$answer_comment_model->id))){
					throw new ErrorException('删除answer_comment中信息失败');
				}
			}

			//删除answer 表中信息
			if(false === Answer::model()->deleteAll('question_id=:question_id',array('question_id'=>$id))){
				throw new ErrorException('删除answer中信息失败');
			}

			//删除question_focus 中信息
			if(false === QuestionFocus::model()->deleteAll('question_id=:question_id',array('question_id'=>$id))){
				throw new ErrorException('删除question_focus 中信息失败');
			}

			$transaction->commit();
			$this->success('删除成功');
		}catch(Exception $e){
			$transaction->rollBack();
			exit($e->getMessage());
			$this->error($e->getMessage());
		}

	}
}

?>