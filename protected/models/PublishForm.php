<?php

class PublishForm extends CFormModel
{
	public $title;
	public $detail;


	public function rules()
	{
		return array(
			// title is required
			array('title', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=>'标题',
			'detail'=>'问题描述',
		);
	}
	
}
