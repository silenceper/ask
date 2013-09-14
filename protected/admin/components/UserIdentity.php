<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	public function authenticate()
	{
		$user=Admin::model()->find("LOWER(username)=? and password=? and status=1",array(strtolower($this->username),md5($this->password)));
		if($user===null)
			return false;
		else
		{
			$this->_id=$user->id;
			$this->setState('userInfo',$user);
			$this->errorCode=UserIdentity::ERROR_NONE;
			return true;
		}
	}
	public function getId()
    {
        return $this->_id;
    }
}