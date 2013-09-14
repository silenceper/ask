<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $email;
	public $password;
	public $re_password;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username,email, password,re_password', 'required'),
			array('email', 'email'),
			array('email', 'length', 'min'=>2, 'max'=>100),
			array('password,re_password', 'length', 'min'=>4, 'max'=>20),
			array('re_password', 'compare','compareAttribute'=>'password','message'=>'两次密码输入不正确'),
			array('username','unique','className'=>'Users','attributeName'=>'username','message'=>'此用户名已经被注册'),
			array('email','unique','className'=>'Users','attributeName'=>'email','message'=>'此Email已经被注册'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'用户名',
			'email'=>'邮箱',
			'password'=>'密码',
			're_password'=>'重复密码',
		);
	}
	
	/**
	 * 注册方法 
	 * 完成数据的插入
	 * @return boolean whether register is successful
	 */
	public function register()
	{
		//将已经验证成功的数据插入数据库
		if(!$this->hasErrors()){
			$user=new Users();
			$user->username=$this->username;
			$user->email=$this->email;
			$user->salt=Help::fetchSalt();
			$user->password=md5(md5($this->password).$user->salt);
			$user->reg_ip=Yii::app()->request->userHostAddress;
			$user->last_ip=Yii::app()->request->userHostAddress;
			$user->reg_time=time();
			$user->last_login=time();
			if(!$user->save()){
				return false;
			}
		}

		//实行登入操作
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
			return false;
	}
}
