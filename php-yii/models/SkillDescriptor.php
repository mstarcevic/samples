<?php

/**
 * This is the model class for table "SkillDescriptor".
 *
 * The followings are the available columns in table 'SkillDescriptor':
 * @property string $skillDescriptorId
 * @property string $subStrandId
 * @property string $levelId
 * @property integer $sequenceNo
 * @property string $description
 * @property integer $slp
 * @property string $explanation
 * @property string $lastUpdatedDate
 * @property string $frameworkId
 * @property string $workSampleId
 *
 * The followings are the available model relations:
 * @property Assessment[] $assessments
 * @property SLPOutcome[] $sLPOutcomes
 * @property Framework $framework
 * @property Level $level
 * @property SubStrand $subStrand
 * @property WorkSample $workSample
 */
class SkillDescriptor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SkillDescriptor the static model class
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
		return 'SkillDescriptor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subjectId, strandId, levelId, subStrandId, description', 'required'),
			array('sequenceNo, slp', 'numerical', 'integerOnly'=>true),
			array('subjectId, strandId, levelId, subStrandId, frameworkId, workSampleId', 'length', 'max'=>10),
            array('ausvelsRef', 'length', 'max'=>20),
			array('subjectId, strandId, explanation', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('skillDescriptorId, subStrandId, levelId, sequenceNo, ausvelsRef', 'safe', 'on'=>'search'),
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
			'assessments' => array(self::HAS_MANY, 'Assessment', 'skillDescriptorId'),
			'slpOutcomes' => array(self::HAS_MANY, 'SLPOutcome', 'skillDescriptorId'),
			'framework' => array(self::BELONGS_TO, 'Framework', 'frameworkId'),
			'level' => array(self::BELONGS_TO, 'Level', 'levelId'),
			'subStrand' => array(self::BELONGS_TO, 'SubStrand', 'subStrandId'),
			'workSample' => array(self::BELONGS_TO, 'WorkSample', 'workSampleId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'skillDescriptorId' => 'Skill Descriptor',
            'subjectId' => 'Subject',
            'strandId' => 'Strand',
            'levelId' => 'Level',
			'subStrandId' => 'Sub Strand',
			'sequenceNo' => 'Sequence No',
            'ausvelsRef' => 'AusVELS Reference',
			'description' => 'Description',
			'slp' => 'Slp Outcome',
			'explanation' => 'Explanation',
			'frameworkId' => 'Framework',
			'workSampleId' => 'Work Sample',
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

		$criteria->compare('skillDescriptorId',$this->skillDescriptorId,true);
        $criteria->compare('subjectId',$this->subjectId,true);
        $criteria->compare('strandId',$this->strandId,true);
        $criteria->compare('levelId',$this->levelId,true);
		$criteria->compare('subStrandId',$this->subStrandId,true);
		$criteria->compare('sequenceNo',$this->sequenceNo);
        $criteria->compare('ausvelsRef',$this->ausvelsRef);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Declare 'virtual' variables not in table but used to receive user input.
     */

    public $subjectId;
    public $strandId;

    /**
     * Do backend stuff before making available for display.
     */
    protected function afterFind()
    {
        // Set 'virtual' variables to that on the corresponding subStrand.
        $this->strandId=SubStrand::model()->findByPk($this->subStrandId)->strandId;
        $this->subjectId=Strand::model()->findByPk($this->strandId)->subjectId;

        return true;
    }

}