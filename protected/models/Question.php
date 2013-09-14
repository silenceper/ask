<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property integer $id
 * @property string $question_content
 * @property string $question_detail
 * @property string $add_time
 * @property string $update_time
 * @property string $published_uid
 * @property string $answer_count
 * @property string $view_count
 * @property string $focus_count
 * @property string $comment_count
 * @property string $best_answer
 * @property integer $has_attach
 * @property integer $lock
 * @property string $ip
 */
class Question extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_content, add_time, update_time, published_uid, ip', 'required'),
			array('has_attach, lock', 'numerical', 'integerOnly'=>true),
			array('question_content', 'length', 'max'=>255),
			array('add_time, update_time, published_uid, answer_count, view_count, focus_count, comment_count, best_answer', 'length', 'max'=>10),
			array('ip', 'length', 'max'=>15),
			array('question_detail', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question_content, question_detail, add_time, update_time, published_uid, answer_count, view_count, focus_count, comment_count, best_answer, has_attach, lock, ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question_content' => 'Question Content',
			'question_detail' => 'Question Detail',
			'add_time' => 'Add Time',
			'update_time' => 'Update Time',
			'published_uid' => 'Published Uid',
			'answer_count' => 'Answer Count',
			'view_count' => 'View Count',
			'focus_count' => 'Focus Count',
			'comment_count' => 'Comment Count',
			'best_answer' => 'Best Answer',
			'has_attach' => 'Has Attach',
			'lock' => 'Lock',
			'ip' => 'Ip',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('question_content',$this->question_content,true);
		$criteria->compare('question_detail',$this->question_detail,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('published_uid',$this->published_uid,true);
		$criteria->compare('answer_count',$this->answer_count,true);
		$criteria->compare('view_count',$this->view_count,true);
		$criteria->compare('focus_count',$this->focus_count,true);
		$criteria->compare('comment_count',$this->comment_count,true);
		$criteria->compare('best_answer',$this->best_answer,true);
		$criteria->compare('has_attach',$this->has_attach);
		$criteria->compare('lock',$this->lock);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}