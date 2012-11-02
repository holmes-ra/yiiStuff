<?php

/**
 * This is the model class for table "yapeal_corpCombatSettings".
 *
 * The followings are the available columns in table 'yapeal_corpCombatSettings':
 * @property string $ownerID
 * @property string $posID
 * @property integer $onAggressionEnabled
 * @property integer $onCorporationWarEnabled
 * @property string $onStandingDropStanding
 * @property integer $onStatusDropEnabled
 * @property string $onStatusDropStanding
 * @property string $useStandingsFromOwnerID
 */
class YCorpCombatSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpCombatSettings the static model class
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
		return 'yapeal_corpCombatSettings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, posID, onAggressionEnabled, onCorporationWarEnabled, onStandingDropStanding, onStatusDropEnabled, onStatusDropStanding, useStandingsFromOwnerID', 'required'),
			array('onAggressionEnabled, onCorporationWarEnabled, onStatusDropEnabled', 'numerical', 'integerOnly'=>true),
			array('ownerID, posID, useStandingsFromOwnerID', 'length', 'max'=>20),
			array('onStandingDropStanding, onStatusDropStanding', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, posID, onAggressionEnabled, onCorporationWarEnabled, onStandingDropStanding, onStatusDropEnabled, onStatusDropStanding, useStandingsFromOwnerID', 'safe', 'on'=>'search'),
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
			'ownerID' => 'Owner',
			'posID' => 'Pos',
			'onAggressionEnabled' => 'On Aggression Enabled',
			'onCorporationWarEnabled' => 'On Corporation War Enabled',
			'onStandingDropStanding' => 'On Standing Drop Standing',
			'onStatusDropEnabled' => 'On Status Drop Enabled',
			'onStatusDropStanding' => 'On Status Drop Standing',
			'useStandingsFromOwnerID' => 'Use Standings From Owner',
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
		$criteria->compare('posID',$this->posID,true);
		$criteria->compare('onAggressionEnabled',$this->onAggressionEnabled);
		$criteria->compare('onCorporationWarEnabled',$this->onCorporationWarEnabled);
		$criteria->compare('onStandingDropStanding',$this->onStandingDropStanding,true);
		$criteria->compare('onStatusDropEnabled',$this->onStatusDropEnabled);
		$criteria->compare('onStatusDropStanding',$this->onStatusDropStanding,true);
		$criteria->compare('useStandingsFromOwnerID',$this->useStandingsFromOwnerID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}