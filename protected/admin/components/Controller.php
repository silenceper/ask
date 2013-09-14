<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column';
	/**
	 * pageKeywords
	 * @var string
	 */
	public $pageKeywords;
	/** 
	 * pageDescription
	 * @var string
	 */
	public $pageDescription;
	/**
	 * site_info
	 * @var string
	 */
	public $site_info;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 *  自定义错误跳转
	 * @param String $mesg
	 * @param String $url
	 * @param int $time
	 */
	public function error($mesg,$url=NULL,$time=3){
		if(!$url){
			$url=isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer :'/';
		}
		$this->render('/site/flash',array(
				'time'=>$time,
				'mesg'=>$mesg,
				'url'=>$url,
		));
		//错误 之后中止  不继续执行之后代码
		Yii::app()->end();
	}
	/**
	 *  自定义成功跳转
	 * @param String $mesg
	 * @param String $url
	 * @param int $time
	 */
	public function success($mesg,$url=NULL,$time=3){
		if(!$url){
			$url=isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer :'/';
		}
		$this->render('/site/flash',array(
				'time'=>$time,
				'mesg'=>$mesg,
				'url'=>$url,
		));
		//错误 之后中止  不继续执行之后代码
		Yii::app()->end();
	}
	/**
	 * _curl
	 * @param  $api
	 * @return mixed
	 */
	protected function _curl($api){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$rep = curl_exec($ch);
		curl_close($ch);
		//curl 错误
		if($rep === false){
	
		}
		return $rep;
	}
	
}