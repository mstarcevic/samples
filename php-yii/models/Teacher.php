<?php

/**
 * This is the model class for table "Teacher".
 *
 * The followings are the available columns in table 'Teacher':
 * @property string $teacherId
 * @property string $teacherNo
 * @property string $firstName
 * @property string $lastName
 * @property string $title
 * @property string $classCode
 * @property integer $specialist
 * @property integer $status
 * @property string $lastUpdatedDate
 *
 * The followings are the available model relations:
 * @property Assessment[] $assessments
 * @property SLPOutcome[] $sLPOutcomes
 */
class Teacher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teacher the static model class
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
		return 'Teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacherNo, firstName, lastName', 'required'),
			array('specialist, status', 'numerical', 'integerOnly'=>true),
			array('teacherNo, title', 'length', 'max'=>10),
			array('firstName, lastName', 'length', 'max'=>50),
			array('classCode', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('teacherId, teacherNo, firstName, lastName, title, classCode, specialist', 'safe', 'on'=>'search'),
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
			'assessments' => array(self::HAS_MANY, 'Assessment', 'teacherId'),
			'sLPOutcomes' => array(self::HAS_MANY, 'SLPOutcome', 'teacherId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'teacherId' => 'Teacher',
			'teacherNo' => 'Teacher No',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'title' => 'Title',
			'classCode' => 'Class Code',
			'specialist' => 'Specialist',
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

		$criteria->compare('teacherId',$this->teacherId,true);
		$criteria->compare('teacherNo',$this->teacherNo,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('classCode',$this->classCode,true);
		$criteria->compare('specialist',$this->specialist);
		$criteria->compare('status',1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}