<?php
/**
 * 话题管理
 * @author silenceper
 *
 */

class TopicController extends BaseController{
	/*
	 * 显示话题列表
	 * 
	 */
	public function actionIndex(){
		
		$this->render('index');
	}
}

?>