<?php
/**
 * 搜索控制器
 * @author silenceper
 *
 */
class SearchController extends Controller{
	//搜索处理
	public function actionIndex($word){
		//获取搜索关键字
		if($word==''){
			$this->error('未填入搜索关键字');
		}
		
		//搜索内容
		$sql="select `id`,`question_content`,`lock`,`best_answer`,`view_count`,`answer_count` from {{question}} where `question_content` like '%{$word}%'";
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
			'word'=>$word,				
		));
	}
	
}

?>