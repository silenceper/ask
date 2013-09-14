<?php


class CommentForm extends CFormModel {
	public $message;
	public $comment_id;
	
	public function rules()
	{
		return array(
				// title is required
				array('message', 'required'),
				array('message', 'length', 'min'=>4),
		);
	}
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'message'=>'回复内容',
		);
	}
	
}

?>