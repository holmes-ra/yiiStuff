<?php

/**
 * This is the model class for table "yapeal_corpOutpostList".
 *
 * The followings are the available columns in table 'yapeal_corpOutpostList':
 * @property string $ownerID
 * @property string $dockingCostPerShipVolume
 * @property string $officeRentalCost
 * @property string $reprocessingEfficiency
 * @property string $reprocessingStationTake
 * @property string $solarSystemID
 * @property string $standingOwnerID
 * @property string $stationID
 * @property string $stationName
 * @property string $stationTypeID
 */
class YCorpOutpostList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpOutpostList the static model class
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
		return 'yapeal_corpOutpostList';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, dockingCostPerShipVolume, officeRentalCost, reprocessingEfficiency, reprocessingStationTake, solarSystemID, standingOwnerID, stationID, stationName, stationTypeID', 'required'),
			array('ownerID, solarSystemID, standingOwnerID, stationID, stationTypeID', 'length', 'max'=>20),
			array('dockingCostPerShipVolume, officeRentalCost', 'length', 'max'=>17),
			array('reprocessingEfficiency, reprocessingStationTake', 'length', 'max'=>5),
			array('stationName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, dockingCostPerShipVolume, officeRentalCost, reprocessingEfficiency, reprocessingStationTake, solarSystemID, standingOwnerID, stationID, stationName, stationTypeID', 'safe', 'on'=>'search'),
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
			'dockingCostPerShipVolume' => 'Docking Cost Per Ship Volume',
			'officeRentalCost' => 'Office Rental Cost',
			'reprocessingEfficiency' => 'Reprocessing Efficiency',
			'reprocessingStationTake' => 'Reprocessing Station Take',
			'solarSystemID' => 'Solar System',
			'standingOwnerID' => 'Standing Owner',
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

		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('dockingCostPerShipVolume',$this->dockingCostPerShipVolume,true);
		$criteria->compare('officeRentalCost',$this->officeRentalCost,true);
		$criteria->compare('reprocessingEfficiency',$this->reprocessingEfficiency,true);
		$criteria->compare('reprocessingStationTake',$this->reprocessingStationTake,true);
		$criteria->compare('solarSystemID',$this->solarSystemID,true);
		$criteria->compare('standingOwnerID',$this->standingOwnerID,true);
		$criteria->compare('stationID',$this->stationID,true);
		$criteria->compare('stationName',$this->stationName,true);
		$criteria->compare('stationTypeID',$this->stationTypeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}