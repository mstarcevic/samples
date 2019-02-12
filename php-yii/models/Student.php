<?php

/**
 * This is the model class for table "Student".
 *
 * The followings are the available columns in table 'Student':
 * @property string $studentId
 * @property string $casesId
 * @property string $firstName
 * @property string $lastName
 * @property string $preferredName
 * @property string $birthDate
 * @property string $gender
 * @property string $homeGroup
 * @property integer $status
 * @property string $lastUpdatedDate
 *
 * The followings are the available model relations:
 * @property Assessment[] $assessments
 * @property SLPOutcome[] $sLPOutcomes
 */
class Student extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
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
		return 'Student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('casesId, firstName, lastName, birthDate, gender', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('casesId', 'length', 'max'=>7),
			array('firstName, lastName, preferredName', 'length', 'max'=>50),
			array('gender', 'length', 'max'=>1),
            array('homeGroup', 'length', 'max'=>3),
            array('birthDate', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('studentId, casesId, firstName, lastName, preferredName, birthDate, gender, homeGroup', 'safe', 'on'=>'search'),
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
			'assessments' => array(self::HAS_MANY, 'Assessment', 'studentId'),
			'sLPOutcomes' => array(self::HAS_MANY, 'SLPOutcome', 'studentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'studentId' => 'Student',
			'casesId' => 'Cases ID',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'preferredName' => 'Preferred Name',
			'birthDate' => 'Birth Date',
			'gender' => 'Gender',
            'homeGroup' => 'Home Group',
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

		$criteria->compare('studentId',$this->studentId,true);
		$criteria->compare('casesId',$this->casesId,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('preferredName',$this->preferredName,true);
		$criteria->compare('birthDate',$this->birthDate,true);
		$criteria->compare('gender',$this->gender,true);
        $criteria->compare('homeGroup',$this->homeGroup,true);
		$criteria->compare('status',1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Do backend stuff before saving to database.
     */
    protected function beforeSave()
    {
        // Convert date format from MySQL's yyyy-mm-dd to display format of dd/mm/yyyy.
        $fromDate=DateTime::createFromFormat('d/m/Y',$this->birthDate);
        $this->birthDate=$fromDate->format('Y-m-d');

        parent::beforeSave();
        return true;
    }

    /**
     * Do backend stuff before making available for display.
     */
    protected function afterFind()
    {
        // Convert date format from display format of dd/mm/yyyy to MySQL's yyyy-mm-dd.
        $fromDate=DateTime::createFromFormat('Y-m-d',$this->birthDate);
        $this->birthDate=$fromDate->format('d/m/Y');

        parent::afterFind();
        return true;
    }

}