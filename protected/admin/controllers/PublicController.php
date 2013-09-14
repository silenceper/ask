<?php
class PublicController extends Controller{
	public $layout=null;
	public $defaultAction='login';
	
	/**
	 * 登入动作
	 */
	public function actionlogin(){
		if(!Yii::app()->user->isGuest){
			$this->redirect(array('site/index'));
		}
		$model=new LoginForm();
		$this->renderPartial('login',array(
				'model'=>$model,
		),$return=false,$processOutput=true);
	}
	
	/**
	 * checklogin
	 * 
	 */
	public function actionCheckLogin(){
		$model=new LoginForm();
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login()){
				//更新登入时间
				$user=Admin::model()->findByPk(yii::app()->user->id);
				$user->login_time=time();
				//save
				$user->save();
				$this->redirect(Yii::app()->request->urlReferrer);
			}else{
				exit('登入失败!');
			}
		}else{
			$this->error('错误的请求',$this->createUrl('site/index'));
		}
	}
	
	/**
	 * 退出
	 */
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect($this->createUrl('public/login'));
	}
	
	
	
	
	/**
	 * 错误捕获
	 */
	public function actionError(){
		if($error=Yii::app()->errorHandler->error){
	
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}

?>