<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property string $Content
 * @property integer $Status
 * @property string $Create_time
 * @property integer $Author
 * @property integer $Task_id
 *
 * The followings are the available model relations:
 * @property Task $task
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Content, Status, Author, Task_id', 'required'),
			array('Status, Author, Task_id', 'numerical', 'integerOnly'=>true),
			array('Create_time', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Content, Status, Create_time, Author, Task_id', 'safe', 'on'=>'search'),
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
			'task' => array(self::BELONGS_TO, 'Task', 'Task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Content' => 'Content',
			'Status' => 'Status',
			'Create_time' => 'Create Time',
			'Author' => 'Author',
			'Task_id' => 'Task',
		);
	}

	/**
	*	Find all records
	*	@return $attributes {array}
	*/
	public function findAllApi()
	{
		$model = $this->findAll();

		$summary = array();

		foreach($model as $data)
			$summary[] = $data->attributes;
	
		return $summary;
	}

	/**
	*	Find record
	*	@param $id {int}
	*	@return $attributes {array:null}
	*/
	public function findApi($id)
	{
		// Check if the requested record exists
		if($model = $this->findbyPk($id))
			return $model->attributes;
		
		// if it doesn't exist then return null;
		return null;
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
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Create_time',$this->Create_time,true);
		$criteria->compare('Author',$this->Author);
		$criteria->compare('Task_id',$this->Task_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
