<?php

/**
 * This is the model class for table "yapeal_corpAttackers".
 *
 * The followings are the available columns in table 'yapeal_corpAttackers':
 * @property string $killID
 * @property string $allianceID
 * @property string $allianceName
 * @property string $characterID
 * @property string $characterName
 * @property string $corporationID
 * @property string $corporationName
 * @property string $damageDone
 * @property string $factionID
 * @property string $factionName
 * @property integer $finalBlow
 * @property double $securityStatus
 * @property string $shipTypeID
 * @property string $weaponTypeID
 */
class YCorpAttackers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpAttackers the static model class
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
		return 'yapeal_corpAttackers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('killID, allianceID, characterID, corporationID, factionID, factionName, finalBlow, securityStatus, shipTypeID, weaponTypeID', 'required'),
			array('finalBlow', 'numerical', 'integerOnly'=>true),
			array('securityStatus', 'numerical'),
			array('killID, allianceID, characterID, corporationID, damageDone, factionID, shipTypeID, weaponTypeID', 'length', 'max'=>20),
			array('allianceName, characterName, corporationName, factionName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('killID, allianceID, allianceName, characterID, characterName, corporationID, corporationName, damageDone, factionID, factionName, finalBlow, securityStatus, shipTypeID, weaponTypeID', 'safe', 'on'=>'search'),
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
			'damageDone' => 'Damage Done',
			'factionID' => 'Faction',
			'factionName' => 'Faction Name',
			'finalBlow' => 'Final Blow',
			'securityStatus' => 'Security Status',
			'shipTypeID' => 'Ship Type',
			'weaponTypeID' => 'Weapon Type',
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
		$criteria->compare('damageDone',$this->damageDone,true);
		$criteria->compare('factionID',$this->factionID,true);
		$criteria->compare('factionName',$this->factionName,true);
		$criteria->compare('finalBlow',$this->finalBlow);
		$criteria->compare('securityStatus',$this->securityStatus);
		$criteria->compare('shipTypeID',$this->shipTypeID,true);
		$criteria->compare('weaponTypeID',$this->weaponTypeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}