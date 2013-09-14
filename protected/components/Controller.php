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
	public $layout='//layouts/column1';
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
		$this->render('/site/flash-error',array(
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
		$this->render('/site/flash-success',array(
				'time'=>$time,
				'mesg'=>$mesg,
				'url'=>$url,
		));
		//错误 之后中止  不继续执行之后代码
		Yii::app()->end();
	}

	/**
	 * 通过question_id获取话题数组
	 * @param unknown $id
	 */
	public function getTopicByQuestionId($id){
		$sql="select `{{topic_question}}`.`topic_id`,`{{topic_question}}`.`question_id`,`{{topic}}`.`topic_title`,`{{topic}}`.`add_time`,`{{topic}}`.`discuss_count` from `{{topic}}` 
				left join `{{topic_question}}` on (`{{topic_question}}`.`topic_id`=`{{topic}}`.`id`) where `{{topic_question}}`.`question_id`=$id" ;
		$connection=Yii::app()->db;
		return $connection->createCommand($sql)->queryAll();
	}
	
	/**
	 * 登入是否验证
	 */
	
	protected function checkAuth(){
		if(Yii::app()->user->isGuest){
			//跳转至首页
			$this->error('您还未登入，不能进行此操作',Yii::app()->homeUrl);
		}
	}

	/*
	*问题是否已经被锁定
	*/
	protected function is_lock($id){
		$question_model=Question::model()->findByPk($id,array(
			'select'=>'`lock`'
			));
		return $question_model['lock']==1;
	}

	/**
	 * 检查该用户是否具有更新的权限
	 * 只有该用户的发表者可以修改
	 */
	public function checkUpdateAuth($id){
		if(Yii::app()->user->isGuest){
			return false;
		}
		//获取uid
		$model=Question::model()->findByPk($id,array(
				'select'=>'`published_uid`,`best_answer`,`lock`',
			));
		if(!$model){
			return false;
		}
		//只有未锁定 未选择最佳答案的问题方可进行编辑
		 if($model['published_uid']==Yii::app()->user->id && $model['best_answer']==0 && $model['lock']==0){
		 	return true;
		 }else{
		 	return false;
		 }
	}
}