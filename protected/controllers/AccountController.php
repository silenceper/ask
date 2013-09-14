<?php
/**
 * 修改账户信息
 *
 */
class AccountController extends BaseController{
	/**
	 *  显示账户信息
	 */
	public function actionIndex(){
		//获取登入用户的信息
		$user_model=Users::model()->findByPk(Yii::app()->user->id);
		$this->render('index',array(
				'user_model'=>$user_model,
			));
	}

	/**
	 * 更改账户信息
	 */
	public function actionCheckAccount(){
		//var_dump($_POST);
		//exit();
		if(!Yii::app()->request->isPostRequest){
			$this->error('一定是你的提交方式不对');
		}

		$data=array();
		if(!isset($_POST['username']) || !isset($_POST['sex']) || !isset($_POST['email'])){
			$this->error('相关字段不能为空');
		}

		$data['username']=$_POST['username'];
		$data['sex']=$_POST['sex'];
		$data['mobile']=$_POST['mobile'];
		//判断用户名是否已经存在
		if(Users::model()->exists('uid <> :uid AND username=:username',array(':uid'=>Yii::app()->user->id,':username'=>$data['username']))){
			$this->error('用户名已经存在');
			return;
		}
		
		//判断是否需要改密码
		if($_POST['old_password']!='' && $_POST['re_password']!='' && $_POST['password']!=''){
			//密码长度不能小于4
			if(strlen($_POST['password'])<4){
				$this->error('密码长度不能小于4');
			}

			//判断两次密码输入是否正确
			if($_POST['password']!=$_POST['re_password']){
				$this->error('两次密码输入不相同');
			}

			//判断初始密码是否正确
			$user=Users::model()->find('uid=? AND password=MD5(CONCAT(MD5(?),`salt`))',array(Yii::app()->user->id,$_POST['old_password']));
			if(!$user){
				$this->error('初始密码输入不正确！');
			}

			//可以更新密码
			$data['salt']=Help::fetchSalt();
			$data['password']=md5(md5(trim($_POST['password'])).$data['salt']);	
		}

		//头像更新
		//更新头像
		$image=Help::uploadAvatar(Yii::app()->user->id,'avatar');
		if($image){
			$data['avatar_file']=$image;
			//更新头像session
			//
		}

		if(false !== Users::model()->updateByPk(Yii::app()->user->id,$data)){
			//更新 userInfo 信息
			$user=Users::model()->findByPk(Yii::app()->user->id);
			Yii::app()->user->setState('userInfo',$user);
			$this->success('更新成功');
		}

	}
}

?>