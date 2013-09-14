<?php

class AnswerForm extends CFormModel
{
	public $answer_content;
	public $question_id;
	public $uid;


	public function rules()
	{
		return array(
			// title is required
			array('answer_content,question_id,uid', 'required'),
			array('uid,question_id','numerical','integerOnly'=>true),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'answer_content'=>'回复内容',
			'question_id'=>'问题ID',
			'uid'=>'用户id',
		);
	}
	
}
