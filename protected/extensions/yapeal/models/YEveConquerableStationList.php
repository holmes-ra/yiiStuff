<?php

/**
 * This is the model class for table "yapeal_eveConquerableStationList".
 *
 * The followings are the available columns in table 'yapeal_eveConquerableStationList':
 * @property string $corporationID
 * @property string $corporationName
 * @property string $solarSystemID
 * @property string $stationID
 * @property string $stationName
 * @property string $stationTypeID
 */
class YEveConquerableStationList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YEveConquerableStationList the static model class
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
		return 'yapeal_eveConquerableStationList';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stationID', 'required'),
			array('corporationID, solarSystemID, stationID, stationTypeID', 'length', 'max'=>20),
			array('corporationName, stationName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('corporationID, corporationName, solarSystemID, stationID, stationName, stationTypeID', 'safe', 'on'=>'search'),
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
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
			'solarSystemID' => 'Solar System',
			'stationID' => 'Station',
			'stationName' => 'Station Name',
			'stationTypeID' => 'Station Type',
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

		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);
		$criteria->compare('solarSystemID',$this->solarSystemID,true);
		$criteria->compare('stationID',$this->stationID,true);
		$criteria->compare('stationName',$this->stationName,true);
		$criteria->compare('stationTypeID',$this->stationTypeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}