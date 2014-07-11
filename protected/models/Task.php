<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $Status
 * @property string $Create_time
 * @property string $Update_time
 * @property string $Tags
 * @property integer $Project_id
 * @property integer $User_id
 * @property string $Assigned
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Project $project
 * @property User $user
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Status, Project_id, User_id', 'required'),
			array('Status, Project_id, User_id', 'numerical', 'integerOnly'=>true),
			array('Name, Create_time, Update_time, Assigned', 'length', 'max'=>45),
			array('Description, Tags', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Name, Description, Status, Create_time, Update_time, Tags, Project_id, User_id, Assigned', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'Task_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'Project_id'),
			'user' => array(self::BELONGS_TO, 'User', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Name' => 'Name',
			'Description' => 'Description',
			'Status' => 'Status',
			'Create_time' => 'Create Time',
			'Update_time' => 'Update Time',
			'Tags' => 'Tags',
			'Project_id' => 'Project',
			'User_id' => 'User',
			'Assigned' => 'Assigned',
		);
	}

	public function findRecentTasks($limit=10)
	{
		return $this->findAll(array(
			'condition'=>'Status=1',
			'order'=>'id DESC',
			'limit'=>$limit
		));
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Create_time',$this->Create_time,true);
		$criteria->compare('Update_time',$this->Update_time,true);
		$criteria->compare('Tags',$this->Tags,true);
		$criteria->compare('Project_id',$this->Project_id);
		$criteria->compare('User_id',$this->User_id);
		$criteria->compare('Assigned',$this->Assigned,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
