<?php
/**
 * 话题
 * @author silenceper
 *
 */

class TopicController extends Controller {
	//显示有关toipc的问题
	public function actionIndex($id){
		//搜索内容
		$sql="select `{{question}}`.`id`,`{{topic}}`.`topic_title`,`{{question}}`.`question_content`,`{{question}}`.`lock`,`{{question}}`.`best_answer`,`{{question}}`.`view_count`,`{{question}}`.`answer_count` from `{{question}}` left join `{{topic_question}}` on (`{{topic_question}}`.`question_id`=`{{question}}`.`id`) left join `{{topic}}` on (`{{topic}}`.`id`=`{{topic_question}}`.`topic_id`) where `{{topic}}`.`id`=$id ";
		$question_models=Yii::app()->db->createCommand($sql)->queryAll();
		$connection=Yii::app()->db;
		$criteria = new CDbCriteria;
		$count=count($question_models);
		$pages = new CPagination($count);
		$pages->pageSize = 10;
		$pages->applylimit($criteria);
		$question_models=$connection->createCommand($sql." LIMIT :offset,:limit");
		$question_models->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$question_models->bindValue(':limit', $pages->pageSize);
		$question_models=$question_models->queryAll();
		
		$this->render('index',array(
			'count'=>$count,
			'question_models'=>$question_models,
			'pages'=>$pages,
		));
	}
}

?>