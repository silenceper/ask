<?php 

/**
* 发布新问题
*/
class PublishController extends BaseController
{
    public $defaultAction='create';
    
	/**
	 * 发起一个新问题
	 */
    public function actionCreate()
    {
    	
        $this->render('create');
    }


 	/**
 	 * 检查问题
 	 * 
 	 */
    public function actionCheckCreate()
    {
        if(!isset($_POST)){
            $this->error('一定是你的打开方式不对');
        }
        //使用事物处理插入
       $transaction=Yii::app()->db->beginTransaction();
       try {
	       $question=new Question();
	       $question->question_content=htmlspecialchars($_POST['PublishForm']['title']);
	       $question->question_detail=htmlspecialchars($_POST['PublishForm']['detail']);
	       $question->add_time=time();
	       $question->update_time=time();
	       $question->published_uid=Yii::app()->user->id;
	       $question->ip=Yii::app()->request->userHostAddress;
	       //插入
	       if(!$question->save()){
	       		throw new ErrorException("添加失败");
	       }
	       //获取返回的question_id
	       $question_id=$question->primaryKey;
	       if(isset($_POST['topic'])){
		       //处理话题 判断话题是否已经存在数据库中 如果存在则返回id  否则重新插入获取id  并插入topic_question中
		       $topics=$_POST['topic'];
		       $criteria=new CDbCriteria();
		       $criteria->condition="topic_title=:topic_title";
		       $criteria->select='id,discuss_count';
		       
		       foreach($topics as $topic){
		       		//循环查找
		       		$criteria->params=array(':topic_title'=>$topic);
		       		$topic_id_model=Topic::model()->find($criteria);
		       		if(!$topic_id_model){
		       			//未在数据库中找到则插入并返回id
						$topic_id=$this->insertTopic($topic);
						if(!$topic_id){
							//插入失败
							throw new ErrorException("话题添加失败1");
						}
		       		}else{
		       			$topic_id=$topic_id_model->id;
		       			//更新 topic 表中 discuss_count字段+1
		       			$topic_id_model->discuss_count=$topic_id_model->discuss_count+1;
		       			if(!$topic_id_model->save(false)){
							//var_dump($topic_id_model->errors);
		       				throw new ErrorException("话题添加失败2");
		       			};
		       		}
		       		
		       		//插入 topic_question 中
		       		if(!$this->insertTopicQuestion($topic_id, $question_id)){
		       			throw new ErrorException("添加失败");
		       		}
		       }
	       }
	       $transaction->commit();
	       $this->success('添加成功',$this->createUrl('question/index',array('id'=>$question_id)));
       }catch(Exception $e){
	       $transaction->rollBack();
// 	       exit($e->getMessage());
	       $this->error($e->getMessage());
       }
       
    }
    
    /**
     * 
     * @param String $topic
     * @return mixed|boolean
     */
	private function insertTopic($topic){
		$topic_model=new Topic();
		$topic_model->discuss_count=1;
		$topic_model->add_time=time();
		$topic_model->topic_title=$topic;
		if($topic_model->save()){
			return $topic_model->primaryKey;
		}
// 		throw new ErrorException(var_dump($topic_model->errors));
		return false;
	}
	
	/**
	 * 插入topic_question表中
	 */
	private function insertTopicQuestion($topic_id,$question_id){
		$tq_model=new TopicQuestion();
		$tq_model->topic_id=$topic_id;
		$tq_model->question_id=$question_id;
		$tq_model->add_time=time();
		$tq_model->uid=Yii::app()->user->id;
		if($tq_model->save()){
			return true;
		}
// 		throw new ErrorException(var_dump($tq_model->errors));
		return false;
	}

	/**
	 * 更新
	 */
	public function actionUpdate($id){
		if(!$this->checkUpdateAuth($id)){
			$this->error('没有权限修改！');
		}

		$question_model=Question::model()->findByPk($id);
		//topic 获取
		$sql="select `{{topic}}`.`topic_title` from `{{topic}}` left join `{{topic_question}}` on (`{{topic_question}}`.`topic_id`=`{{topic}}`.`id`) where `{{topic_question}}`.`question_id`=?";
		$topic_models=Yii::app()->db->createCommand($sql)->queryAll(true,array($id));
		$this->render('update',array(
				'question_model'=>$question_model,
				'topic_models'=>$topic_models,
			));
	}

	/**
	 *
	 * 处理更新
	 */
	public function actionCheckUpdate(){	
		if(!Yii::app()->request->isPostRequest){
			$this->error('一定是你的打开方式不对!');
		}
		//var_dump($_POST);
		$id=$_POST['id'];
		if(!$this->checkUpdateAuth($id)){
			$this->error('没有权限修改！');
		}	

		//启用事物处理
		$transaction=Yii::app()->db->beginTransaction();
       	try {
			//更新question 表相关信息
			$data=array();
			$data['question_content']=htmlspecialchars($_POST['title']);
		    $data['question_detail']=htmlspecialchars($_POST['detail']);
			if(false === Question::model()->updateByPk($id,$data)){
				$this->error('更新失败');
			}

			//话题更新  如果存在则返回 topic_id  不存在则插入病返回topic_id
			$topics=array_unique($_POST['topic']);			
			if($topics){
				$criteria=new CDbCriteria();
		       	$criteria->condition="topic_title=:topic_title";
		       	$criteria->select='id,discuss_count';
		       	//循环比较插入
				foreach ($topics as $topic) {
					$criteria->params=array(':topic_title'=>$topic);
		       		$topic_id_model=Topic::model()->find($criteria);
		       		if(!$topic_id_model){
		       			//未在数据库中找到则插入并返回id
						$topic_id=$this->insertTopic($topic);
						if(!$topic_id){
							//插入失败
							throw new ErrorException("话题添加失败1");
						}
					}else{
		       			$topic_id=$topic_id_model->id;
		       			//更新 topic 表中 discuss_count字段+1
		       			$topic_id_model->discuss_count=$topic_id_model->discuss_count+1;
		       			if(!$topic_id_model->save(false)){
							//var_dump($topic_id_model->errors);
		       				throw new ErrorException("话题添加失败2");
		       			};
		       		}

		       		//根据topic_id 以及question_id查找是否以及存在 没有则插入
		       		if(!TopicQuestion::model()->exists('topic_id=? AND question_id=?',array($topic_id,$id))){
		       			//插入 topic_question 中
			       		if(!$this->insertTopicQuestion($topic_id, $id)){
			       			throw new ErrorException("添加失败");
			       		}
		       		}

		       		//该问题实际的topic_id
		       		$true_topics[]=$topic_id;
				}

				//获取存在 topic_question 的 topic_id 并查找出其中多出来的
				$criteria=new CDbCriteria();
		       	$criteria->condition="question_id=?";
		       	$criteria->select='topic_id';
		       	$criteria->params=array($id);
		       	$models=TopicQuestion::model()->findAll($criteria);
		       	//所有在topicQuestion中的id
	       		$all_topics=array();	
		       	foreach ($models as $model) {
		       		$all_topics[]=$model['topic_id'];
		       	}

		       	//获取需要删除的 topic_id
	       		$delete_topics=array_diff($all_topics, $true_topics);
	       		//var_dump($delete_topics);
		       	//从 topic_question 表中删除 并在topic 表中 discuss_count 字段-1
		       	foreach ($delete_topics as $delete_topic) {
		       		if(!TopicQuestion::model()->deleteAll('topic_id=? AND question_id=?',array($delete_topic,$id))){
		       			throw new Exception("更新失败");
		       			
		       		}
		       		//disscuss_count字段-1
		       		if(false === Topic::model()->updateByPk($delete_topic,array('discuss_count'=>new CDbExpression("discuss_count-1")))){
		       			throw new Exception("更新失败");
		       		}
		       	}

			}

 		   $transaction->commit();
	       $this->success('修改成功',$this->createUrl('question/index',array('id'=>$id)));
		}catch(Exception $e){
			$transaction->rollBack();
			exit($e->getMessage());
		}
	}

}
?>
