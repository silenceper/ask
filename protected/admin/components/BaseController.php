<?php
/**
 * 权限接口  后台需要验证用户的须继承此控制器
 * @author silenceper
 * 
 */
class BaseController extends Controller{
	/**
	 * 初始化
	 * @see CController::init()
	 */
	public function init(){
		if(Yii::app()->user->isGuest){
			Yii::app()->user->setFlash('actionInfo','您尚未登录系统！');
			$this->redirect(array('public/login'));
		}
	}
	
}

?>