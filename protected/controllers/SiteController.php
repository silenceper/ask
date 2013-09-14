<?php
/**
 * 显示首页控制器
 * @author silenceper
 *
 */
class SiteController extends Controller{
	/**
	 * 显示主页
	 * @param String $order
	 */
	public function actionIndex($order="new"){
		//根据不同的order 选择不同的sql语句
		switch ($order){
			case 'new':
				$sql="select `{{question}}`.`id` as `question_id`,`{{question}}`.`question_content`,`{{question}}`.`add_time`,`{{question}}`.`answer_count`,`{{question}}`.`view_count`,`{{question}}`.`lock`,`{{question}}`.`best_answer`,`{{users}}`.`avatar_file`,`{{users}}`.`uid`
				from `{{question}}`
				left join `{{users}}` on (`{{question}}`.`published_uid`=`{{users}}`.`uid`) order by `{{question}}`.`add_time` desc
				";
				break;
			//热门查看人数排序
			case 'hot':
				$sql="select `{{question}}`.`id` as `question_id`,`{{question}}`.`question_content`,`{{question}}`.`add_time`,`{{question}}`.`answer_count`,`{{question}}`.`view_count`,`{{question}}`.`lock`
				,`{{users}}`.`avatar_file`,`{{users}}`.`uid`
				from `{{question}}`
				left join `{{users}}` on (`{{question}}`.`published_uid`=`{{users}}`.`uid`) order by `{{question}}`.`view_count` desc
				";
				break;
			//未回复数排序
			case 'unresponsive':
				$sql="select `{{question}}`.`id` as `question_id`,`{{question}}`.`question_content`,`{{question}}`.`add_time`,`{{question}}`.`answer_count`,`{{question}}`.`view_count`,`{{question}}`.`lock`
				,`{{users}}`.`avatar_file`,`{{users}}`.`uid`
				from `{{question}}`
				left join `{{users}}` on (`{{question}}`.`published_uid`=`{{users}}`.`uid`) where `{{question}}`.`answer_count` = 0
				";
				break;
			//默认根据时间排序
			default:
				$sql="select `{{question}}`.`id` as `question_id`,`{{question}}`.`question_content`,`{{question}}`.`add_time`,`{{question}}`.`answer_count`,`{{question}}`.`view_count`,`{{question}}`.`lock`
				,`{{users}}`.`avatar_file`,`{{users}}`.`uid`
				from `{{question}}`
				left join `{{users}}` on (`{{question}}`.`published_uid`=`{{users}}`.`uid`) order by `{{question}}`.`add_time` desc
				";
				break;
		}
		
		
		$connection=Yii::app()->db;
		$criteria = new CDbCriteria;
		$models=$connection->createCommand($sql)->queryAll();
		$count=count($models);
		$pages = new CPagination($count);
		$pages->pageSize = 10;
		$pages->applylimit($criteria);
		$models=$connection->createCommand($sql." LIMIT :offset,:limit");
		$models->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$models->bindValue(':limit', $pages->pageSize);
		$models=$models->queryAll();
		
		//获取话题
		$topic_models=Topic::model()->findAll(array(
				'select'=>'id,topic_title',
				'order'=>'discuss_count desc',
				'limit'=>'25',
			));

		$this->pageTitle="首页";
		$this->render('index',array(
			'models'=>$models,
			'pages'=>$pages,	
			'topic_models'=>$topic_models,			
		));
	}
	
	/**
	 * 验证登入
	 */
	public function actionCheckLogin()
	{
		$model=new LoginForm;
	
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->request->urlReferrer);
			}else{
				$this->error("用户名或密码错误");
			}
		}else{
			$this->error('错误的提交方式');
		}
	}

	/**
	 * 用户注册
	 * 
	 */
	public function actionRegister(){
		//已经登入的用户不再现实
		if(!Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->homeUrl);
		}
		$this->render('register');
	}
	
	/**
	 * 用户登入
	 * 
	 */
	public function actionCheckRegister(){
		//已经登入的用户不再现实
		if(!Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->homeUrl);
		}
		
		$model=new RegisterForm();
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		//获取信息
		if(isset($_POST['RegisterForm'])){
			$model->attributes=$_POST['RegisterForm'];
			//验证并是实现注册登入
			if($model->validate() && $model->register()){
				$this->success('注册成功，',Yii::app()->homeUrl);
			}else{
				//var_dump($model->errors);
				//exit();
				$this->error("注册失败",$this->createUrl('site/register'));
			}
		}else{
			$this->error('请求错误',$this->createUrl('site/register'));
		}
		
	}
	
	/**
	 * 退出
	 */
	public function actionLogout(){
		//未登入的用户跳转至登入页面
		if(Yii::app()->user->isGuest){
			Yii::app()->request->redirect($this->createUrl('/'));
		}
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->request->urlReferrer);
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}