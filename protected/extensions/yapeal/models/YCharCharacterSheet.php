<?php

/**
 * This is the model class for table "yapeal_charCharacterSheet".
 *
 * The followings are the available columns in table 'yapeal_charCharacterSheet':
 * @property string $allianceID
 * @property string $allianceName
 * @property string $ancestry
 * @property string $balance
 * @property string $bloodLine
 * @property string $characterID
 * @property string $cloneName
 * @property string $cloneSkillPoints
 * @property string $corporationID
 * @property string $corporationName
 * @property string $DoB
 * @property string $gender
 * @property string $name
 * @property string $race
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $character
 */
class YCharCharacterSheet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharCharacterSheet the static model class
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
		return 'yapeal_charCharacterSheet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ancestry, balance, bloodLine, characterID, cloneName, cloneSkillPoints, corporationID, corporationName, DoB, gender, name, race', 'required'),
			array('allianceID, characterID, cloneSkillPoints, corporationID', 'length', 'max'=>20),
			array('allianceName, ancestry, bloodLine, cloneName, corporationName, gender, name, race', 'length', 'max'=>255),
			array('balance', 'length', 'max'=>17),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('allianceID, allianceName, ancestry, balance, bloodLine, characterID, cloneName, cloneSkillPoints, corporationID, corporationName, DoB, gender, name, race', 'safe', 'on'=>'search'),
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
			'character' => array(self::BELONGS_TO, 'YUtilRegisteredCharacter', 'characterID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'allianceID' => 'Alliance',
			'allianceName' => 'Alliance Name',
			'ancestry' => 'Ancestry',
			'balance' => 'Balance',
			'bloodLine' => 'Blood Line',
			'characterID' => 'Character',
			'cloneName' => 'Clone Name',
			'cloneSkillPoints' => 'Clone Skill Points',
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
			'DoB' => 'Do B',
			'gender' => 'Gender',
			'name' => 'Name',
			'race' => 'Race',
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

		$criteria->compare('allianceID',$this->allianceID,true);
		$criteria->compare('allianceName',$this->allianceName,true);
		$criteria->compare('ancestry',$this->ancestry,true);
		$criteria->compare('balance',$this->balance,true);
		$criteria->compare('bloodLine',$this->bloodLine,true);
		$criteria->compare('characterID',$this->characterID,true);
		$criteria->compare('cloneName',$this->cloneName,true);
		$criteria->compare('cloneSkillPoints',$this->cloneSkillPoints,true);
		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);
		$criteria->compare('DoB',$this->DoB,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('race',$this->race,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}