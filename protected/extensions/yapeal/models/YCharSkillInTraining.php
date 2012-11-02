<?php

/**
 * This is the model class for table "yapeal_charSkillInTraining".
 *
 * The followings are the available columns in table 'yapeal_charSkillInTraining':
 * @property string $currentTQTime
 * @property integer $offset
 * @property string $ownerID
 * @property integer $skillInTraining
 * @property string $trainingDestinationSP
 * @property string $trainingEndTime
 * @property string $trainingStartSP
 * @property string $trainingStartTime
 * @property integer $trainingToLevel
 * @property string $trainingTypeID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharSkillInTraining extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharSkillInTraining the static model class
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
		return 'yapeal_charSkillInTraining';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offset, ownerID, skillInTraining, trainingDestinationSP, trainingStartSP, trainingToLevel, trainingTypeID', 'required'),
			array('offset, skillInTraining, trainingToLevel', 'numerical', 'integerOnly'=>true),
			array('ownerID, trainingDestinationSP, trainingStartSP, trainingTypeID', 'length', 'max'=>20),
			array('currentTQTime, trainingEndTime, trainingStartTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('currentTQTime, offset, ownerID, skillInTraining, trainingDestinationSP, trainingEndTime, trainingStartSP, trainingStartTime, trainingToLevel, trainingTypeID', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'YUtilRegisteredCharacter', 'ownerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'currentTQTime' => 'Current Tqtime',
			'offset' => 'Offset',
			'ownerID' => 'Owner',
			'skillInTraining' => 'Skill In Training',
			'trainingDestinationSP' => 'Training Destination Sp',
			'trainingEndTime' => 'Training End Time',
			'trainingStartSP' => 'Training Start Sp',
			'trainingStartTime' => 'Training Start Time',
			'trainingToLevel' => 'Training To Level',
			'trainingTypeID' => 'Training Type',
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

		$criteria->compare('currentTQTime',$this->currentTQTime,true);
		$criteria->compare('offset',$this->offset);
		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('skillInTraining',$this->skillInTraining);
		$criteria->compare('trainingDestinationSP',$this->trainingDestinationSP,true);
		$criteria->compare('trainingEndTime',$this->trainingEndTime,true);
		$criteria->compare('trainingStartSP',$this->trainingStartSP,true);
		$criteria->compare('trainingStartTime',$this->trainingStartTime,true);
		$criteria->compare('trainingToLevel',$this->trainingToLevel);
		$criteria->compare('trainingTypeID',$this->trainingTypeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}