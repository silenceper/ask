<?php
/**
 *  用户管理
 * @author silenceper
 *
 */

class UserController extends BaseController {
	/*
	 * 显示用户列表
	 */
	public function actionIndex(){
		$sql="select `{{users}}`.`uid`,`{{users}}`.`username`,`{{users}}`.`email`,`{{users}}`.`avatar_file`,`{{users}}`.`sex`,`{{users}}`.`birthday`,`{{users}}`.`reg_time`,`{{users}}`.`reg_ip`,`{{users}}`.`last_login`,`{{users}}`.`last_ip` from `{{users}}`";

		//查找用户
		if(isset($_POST['content'])){
			$sql.=" where `{{users}}`.`username` like '%{$_POST['content']}%'";
		}

		$connection=Yii::app()->db;
		$criteria = new CDbCriteria;
		$models=$connection->createCommand($sql)->queryAll();
		$count=count($models);
		$pages = new CPagination($count);
		$pages->pageSize = 14;
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
	 * update
	 */
	public function actionUpdate($uid){
		$model=Users::model()->findByPk($uid);		
		if(!$model){
			$this->error('不存在该用户');
		}

		$this->render('update',array(
				'model'=>$model,
			));
	}

	/**
	 * 
	 * 检查update
	 *
	 */
	public function actionCheckUpdate(){
		if(!Yii::app()->request->isPostRequest){
			$this->error('一定是您的访问方式不对','/');
		}
		//执行更新操作
		//var_dump($_POST);
		$data=array();
		$data['username']=$_POST['username'];
		$data['sex']=$_POST['sex'];
		$data['mobile']=$_POST['mobile'];
		//生日更新  
		$birthday=$_POST['birthday'];
		$year=substr($birthday,0,4);
		$month=substr($birthday,5,2);
		$day=substr($birthday, 8,2);
		$data['birthday']=mktime(0,0,0,$month,$day,$year);
		//密码更新
		if($_POST['password']){
			$data['salt']=Help::fetchSalt();
			$data['password']=md5(md5(trim($_POST['password'])).$data['salt']);	
		}
		
		//更新头像
		$image=Help::uploadAvatar($_POST['uid'],'avatar');
		if($image){
			$data['avatar_file']=$image;
		}

		if(false !== Users::model()->updateByPk($_POST['uid'],$data)){
			$this->success('更新成功',$this->createUrl('index'));
		}
	}

	/**
	 * 添加用户
	 */
	public function actionAdd(){
		$this->render('add');
	}

	/**
	 * 处理添加用户
	 */
	public function actionCheckAdd()
	{	
		if(!Yii::app()->request->isPostRequest){
			$this->error('一定是您的访问方式不对');
		}
		//var_dump($_POST);
		//判断用户名或email是否已经存在
		if(Users::model()->exists('username=? or email=?', array($_POST['username'],$_POST['email']))){
			$this->error('用户名或密码已经存在!');
		}

		//首先插入数据获取uid
		$user=new Users;
		$user->username=$_POST['username'];
		$user->email=$_POST['email'];
		//生日更新  
		$birthday=$_POST['birthday'];
		$year=substr($birthday,0,4);
		$month=substr($birthday,5,2);
		$day=substr($birthday, 8,2);
		$user->birthday=mktime(0,0,0,$month,$day,$year);
		$user->mobile=$_POST['mobile'];
		$user->sex=$_POST['sex'];
		$user->salt=Help::fetchSalt();
		$user->password=md5(md5($_POST['password']).$user->salt);
		$user->reg_time=time();
		$user->reg_ip=Yii::app()->request->userHostAddress;
		$user->last_login=time();
		$user->last_ip=Yii::app()->request->userHostAddress;

		if($user->save()){
			$this->success('添加成功!');
		}else{
			$this->error(var_dump($user->errors));
		}

	}


	/**
	 * 获取提问数
	 */
	public function getQuestionCount($uid){
		return Question::model()->count('published_uid=:uid',array(':uid'=>$uid));
	}

	/**
	 * 获取回答数
	 */
	public function getAnswerCount($uid){
		return Answer::model()->count('uid=:uid',array(':uid'=>$uid));
	}

}

?>