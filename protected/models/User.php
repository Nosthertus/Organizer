<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, emailNotification', 'required'),
			array('username, password, email', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, emailNotification', 'safe', 'on'=>'search'),
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
			'projects' => array(self::HAS_MANY, 'Project', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'emailNotification' => 'Email Notification',
			'ProjectNotification' => 'Project Notification',
			'NewTaskNotification' => 'New Task Notification',
			'UpdatedTaskNotification' => 'Updated Task Notification',
			'CommentedTaskNotification' => 'Commented Task Notification',
		);
	}

	public function validatePassword($password)
	{
		return $this->hashPassword($password, $this->session) === $this->password;
	}

	public function hashPassword($password, $salt)
	{
		return md5($salt.$password);
	}

	public function generateSalt()
	{
		return uniqid('', true);
	}

	public function getAllEmails()
	{
		$users = $this->findAll();

		$user = array();

		foreach($user as $data)
			$user[] = $data->email;

		return $user;
	}

	public function ListNotification($id)
	{
		$list = array();

		$user = $this->findByPk($id);

		if($user->ProjectNotification == '1')
			$list[] = 0;

		if($user->NewTaskNotification == '1')
			$list[] = 1;

		if($user->UpdatedTaskNotification == '1')
			$list[] = 2;

		if($user->CommentedTaskNotification == '1')
			$list[] = 3;

		return $list;
	}

	//Check if user is able to recieve the especific notification.
	public function getEmailNotification($user = array('id'=>null, 'Notification'))
	{
		if(isset($user['id']))
		{
			$userData = $this->findByPk($user['id']);

			if($userData['emailNotification'] == '1' && $userData[$user['Notification']] == '1')
				return $userData->email;
		}

		else
		{
			$usersData = $this->findAll();

			$emails = array();
			foreach($usersData as $data)
			{
				if($data['emailNotification'] == '1' && $data[$user['Notification']] == '1')
					$emails[] = $data->email;
			}

			return $emails;
		}

	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
