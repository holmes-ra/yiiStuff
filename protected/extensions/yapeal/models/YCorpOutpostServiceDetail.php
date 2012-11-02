<?php

/**
 * This is the model class for table "yapeal_corpOutpostServiceDetail".
 *
 * The followings are the available columns in table 'yapeal_corpOutpostServiceDetail':
 * @property string $ownerID
 * @property string $stationID
 * @property string $discountPerGoodStanding
 * @property string $minStanding
 * @property string $serviceName
 * @property string $surchargePerBadStanding
 */
class YCorpOutpostServiceDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpOutpostServiceDetail the static model class
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
		return 'yapeal_corpOutpostServiceDetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, stationID, discountPerGoodStanding, minStanding, serviceName, surchargePerBadStanding', 'required'),
			array('ownerID, stationID', 'length', 'max'=>20),
			array('discountPerGoodStanding, minStanding, surchargePerBadStanding', 'length', 'max'=>5),
			array('serviceName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, stationID, discountPerGoodStanding, minStanding, serviceName, surchargePerBadStanding', 'safe', 'on'=>'search'),
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
			'stationID' => 'Station',
			'discountPerGoodStanding' => 'Discount Per Good Standing',
			'minStanding' => 'Min Standing',
			'serviceName' => 'Service Name',
			'surchargePerBadStanding' => 'Surcharge Per Bad Standing',
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
		$criteria->compare('stationID',$this->stationID,true);
		$criteria->compare('discountPerGoodStanding',$this->discountPerGoodStanding,true);
		$criteria->compare('minStanding',$this->minStanding,true);
		$criteria->compare('serviceName',$this->serviceName,true);
		$criteria->compare('surchargePerBadStanding',$this->surchargePerBadStanding,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}