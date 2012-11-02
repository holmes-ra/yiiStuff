<?php

/**
 * This is the model class for table "yapeal_charSkillQueue".
 *
 * The followings are the available columns in table 'yapeal_charSkillQueue':
 * @property string $endSP
 * @property string $endTime
 * @property integer $level
 * @property string $ownerID
 * @property integer $queuePosition
 * @property string $startSP
 * @property string $startTime
 * @property string $typeID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharSkillQueue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharSkillQueue the static model class
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
		return 'yapeal_charSkillQueue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('endSP, endTime, level, ownerID, queuePosition, startSP, startTime, typeID', 'required'),
			array('level, queuePosition', 'numerical', 'integerOnly'=>true),
			array('endSP, ownerID, startSP, typeID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('endSP, endTime, level, ownerID, queuePosition, startSP, startTime, typeID', 'safe', 'on'=>'search'),
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
			'endSP' => 'End Sp',
			'endTime' => 'End Time',
			'level' => 'Level',
			'ownerID' => 'Owner',
			'queuePosition' => 'Queue Position',
			'startSP' => 'Start Sp',
			'startTime' => 'Start Time',
			'typeID' => 'Type',
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

		$criteria->compare('endSP',$this->endSP,true);
		$criteria->compare('endTime',$this->endTime,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('queuePosition',$this->queuePosition);
		$criteria->compare('startSP',$this->startSP,true);
		$criteria->compare('startTime',$this->startTime,true);
		$criteria->compare('typeID',$this->typeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}