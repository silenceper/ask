<?php
/**
 * @author silenceper
 */
class SiteController extends BaseController{
	/**
	 * 显示网站首页
	 */
	public function actionIndex(){
		$this->render('index');
	}

	
	/**
	 * 显示服务器信息
	 */
	public function actionInfo(){
		echo '系统信息！~';
	}
}

?>