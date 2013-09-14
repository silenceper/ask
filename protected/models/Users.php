<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $uid
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property string $salt
 * @property string $avatar_file
 * @property string $sex
 * @property string $birthday
 * @property string $reg_time
 * @property string $reg_ip
 * @property string $last_login
 * @property string $last_ip
 * @property string $fans_count
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password, reg_time, reg_ip, last_login, last_ip', 'required'),
			array('username, password, salt', 'length', 'max'=>50),
			array('email, avatar_file', 'length', 'max'=>255),
			array('mobile', 'length', 'max'=>100),
			array('sex', 'length', 'max'=>6),
			array('birthday, reg_time, last_login, fans_count', 'length', 'max'=>10),
			array('reg_ip, last_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, username, email, mobile, password, salt, avatar_file, sex, birthday, reg_time, reg_ip, last_login, last_ip, fans_count', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'username' => 'Username',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'password' => 'Password',
			'salt' => 'Salt',
			'avatar_file' => 'Avatar File',
			'sex' => 'Sex',
			'birthday' => 'Birthday',
			'reg_time' => 'Reg Time',
			'reg_ip' => 'Reg Ip',
			'last_login' => 'Last Login',
			'last_ip' => 'Last Ip',
			'fans_count' => 'Fans Count',
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

		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('avatar_file',$this->avatar_file,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('reg_time',$this->reg_time,true);
		$criteria->compare('reg_ip',$this->reg_ip,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('fans_count',$this->fans_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}