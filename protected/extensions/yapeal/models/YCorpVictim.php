<?php

/**
 * This is the model class for table "yapeal_corpVictim".
 *
 * The followings are the available columns in table 'yapeal_corpVictim':
 * @property string $killID
 * @property string $allianceID
 * @property string $allianceName
 * @property string $characterID
 * @property string $characterName
 * @property string $corporationID
 * @property string $corporationName
 * @property string $damageTaken
 * @property string $factionID
 * @property string $factionName
 * @property string $shipTypeID
 */
class YCorpVictim extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpVictim the static model class
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
		return 'yapeal_corpVictim';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('killID, allianceID, characterID, corporationID, damageTaken, factionName, shipTypeID', 'required'),
			array('killID, allianceID, characterID, corporationID, damageTaken, factionID, shipTypeID', 'length', 'max'=>20),
			array('allianceName, characterName, corporationName, factionName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('killID, allianceID, allianceName, characterID, characterName, corporationID, corporationName, damageTaken, factionID, factionName, shipTypeID', 'safe', 'on'=>'search'),
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
			'killID' => 'Kill',
			'allianceID' => 'Alliance',
			'allianceName' => 'Alliance Name',
			'characterID' => 'Character',
			'characterName' => 'Character Name',
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
			'damageTaken' => 'Damage Taken',
			'factionID' => 'Faction',
			'factionName' => 'Faction Name',
			'shipTypeID' => 'Ship Type',
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

		$criteria->compare('killID',$this->killID,true);
		$criteria->compare('allianceID',$this->allianceID,true);
		$criteria->compare('allianceName',$this->allianceName,true);
		$criteria->compare('characterID',$this->characterID,true);
		$criteria->compare('characterName',$this->characterName,true);
		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);
		$criteria->compare('damageTaken',$this->damageTaken,true);
		$criteria->compare('factionID',$this->factionID,true);
		$criteria->compare('factionName',$this->factionName,true);
		$criteria->compare('shipTypeID',$this->shipTypeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}