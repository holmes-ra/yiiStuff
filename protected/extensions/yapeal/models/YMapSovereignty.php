<?php

/**
 * This is the model class for table "yapeal_mapSovereignty".
 *
 * The followings are the available columns in table 'yapeal_mapSovereignty':
 * @property string $allianceID
 * @property string $corporationID
 * @property string $factionID
 * @property string $solarSystemID
 * @property string $solarSystemName
 */
class YMapSovereignty extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YMapSovereignty the static model class
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
		return 'yapeal_mapSovereignty';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('allianceID, corporationID, factionID, solarSystemID, solarSystemName', 'required'),
			array('allianceID, corporationID, factionID, solarSystemID', 'length', 'max'=>20),
			array('solarSystemName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('allianceID, corporationID, factionID, solarSystemID, solarSystemName', 'safe', 'on'=>'search'),
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
			'allianceID' => 'Alliance',
			'corporationID' => 'Corporation',
			'factionID' => 'Faction',
			'solarSystemID' => 'Solar System',
			'solarSystemName' => 'Solar System Name',
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
		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('factionID',$this->factionID,true);
		$criteria->compare('solarSystemID',$this->solarSystemID,true);
		$criteria->compare('solarSystemName',$this->solarSystemName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}