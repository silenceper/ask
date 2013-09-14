<?php
/**
 * 登入状态验证类
 * @author work
 *
 */
class BaseController extends Controller{
	/*
		登入验证
	*/
	public function init(){
		if(Yii::app()->user->isGuest){
			//跳转至首页
			$this->redirect(array('site/index'));
		}
	}

}

?>