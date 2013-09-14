<?php

/**
 * This is the model class for table "{{answer}}".
 *
 * The followings are the available columns in table '{{answer}}':
 * @property string $id
 * @property string $question_id
 * @property string $answer_content
 * @property string $add_time
 * @property string $against_count
 * @property string $agree_count
 * @property string $uid
 * @property string $comment_count
 * @property integer $has_attach
 * @property string $ip
 */
class Answer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Answer the static model class
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
		return '{{answer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id, answer_content,uid,add_time,ip', 'required'),
			array('has_attach', 'numerical', 'integerOnly'=>true),
			array('question_id', 'length', 'max'=>11),
			array('add_time, against_count, agree_count, uid, comment_count', 'length', 'max'=>10),
			array('ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, question_id, answer_content, add_time, against_count, agree_count, uid, comment_count, has_attach, ip', 'safe', 'on'=>'search'),
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
			'question_id' => 'Question',
			'answer_content' => 'Answer Content',
			'add_time' => 'Add Time',
			'against_count' => 'Against Count',
			'agree_count' => 'Agree Count',
			'uid' => 'Uid',
			'comment_count' => 'Comment Count',
			'has_attach' => 'Has Attach',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('answer_content',$this->answer_content,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('against_count',$this->against_count,true);
		$criteria->compare('agree_count',$this->agree_count,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('comment_count',$this->comment_count,true);
		$criteria->compare('has_attach',$this->has_attach);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}