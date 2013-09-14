<?php

/**
 * This is the model class for table "{{answer_vote}}".
 *
 * The followings are the available columns in table '{{answer_vote}}':
 * @property integer $id
 * @property string $answer_id
 * @property string $answer_uid
 * @property string $vote_uid
 * @property string $add_time
 * @property integer $vote_value
 */
class AnswerVote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AnswerVote the static model class
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
		return '{{answer_vote}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('answer_id, answer_uid, vote_uid, add_time, vote_value', 'required'),
			array('vote_value', 'numerical', 'integerOnly'=>true),
			array('answer_id, answer_uid, vote_uid', 'length', 'max'=>11),
			array('add_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, answer_id, answer_uid, vote_uid, add_time, vote_value', 'safe', 'on'=>'search'),
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
			'answer_id' => 'Answer',
			'answer_uid' => 'Answer Uid',
			'vote_uid' => 'Vote Uid',
			'add_time' => 'Add Time',
			'vote_value' => 'Vote Value',
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
		$criteria->compare('answer_id',$this->answer_id,true);
		$criteria->compare('answer_uid',$this->answer_uid,true);
		$criteria->compare('vote_uid',$this->vote_uid,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('vote_value',$this->vote_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}