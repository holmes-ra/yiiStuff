<?php

/**
 * This is the model class for table "yapeal_charResearch".
 *
 * The followings are the available columns in table 'yapeal_charResearch':
 * @property string $ownerID
 * @property string $agentID
 * @property string $pointsPerDay
 * @property string $skillTypeID
 * @property double $remainderPoints
 * @property string $researchStartDate
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharResearch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharResearch the static model class
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
		return 'yapeal_charResearch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, agentID, pointsPerDay, remainderPoints, researchStartDate', 'required'),
			array('remainderPoints', 'numerical'),
			array('ownerID, agentID, skillTypeID', 'length', 'max'=>20),
			array('pointsPerDay', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, agentID, pointsPerDay, skillTypeID, remainderPoints, researchStartDate', 'safe', 'on'=>'search'),
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
			'ownerID' => 'Owner',
			'agentID' => 'Agent',
			'pointsPerDay' => 'Points Per Day',
			'skillTypeID' => 'Skill Type',
			'remainderPoints' => 'Remainder Points',
			'researchStartDate' => 'Research Start Date',
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

		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('agentID',$this->agentID,true);
		$criteria->compare('pointsPerDay',$this->pointsPerDay,true);
		$criteria->compare('skillTypeID',$this->skillTypeID,true);
		$criteria->compare('remainderPoints',$this->remainderPoints);
		$criteria->compare('researchStartDate',$this->researchStartDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}