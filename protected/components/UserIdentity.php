<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $email;
	
	/**
	 * 重写父类
	 * @param String $email
	 * @param String $password
	 */
	public function __construct($email=null,$password=null)
	{
		$this->email=$email;
		$this->password=$password;
	}
	/**
	 * 严重
	 * @see CUserIdentity::authenticate()
	 */
	public function authenticate()
	{
		$user=Users::model()->find('email=? AND password=MD5(CONCAT(MD5(?),`salt`))',array($this->email,$this->password));
		if($user===null)
			return false;
		else
		{
			$this->_id=$user->uid;
			//设置一个默认头像
			if(!$user->avatar_file){
				$user->avatar_file=Yii::app()->params['default_avatar'];
			}
			
			$this->setState('userInfo',$user);
			$this->errorCode=UserIdentity::ERROR_NONE;
			return true;
		}
	}
	
	/**
	 * 重写父类
	 * @see CUserIdentity::getId()
	 */
	public function getId()
    {
        return $this->_id;
    }
}