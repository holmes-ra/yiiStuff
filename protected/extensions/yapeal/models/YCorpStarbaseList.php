<?php

/**
 * This is the model class for table "yapeal_corpStarbaseList".
 *
 * The followings are the available columns in table 'yapeal_corpStarbaseList':
 * @property string $ownerID
 * @property string $itemID
 * @property string $locationID
 * @property string $moonID
 * @property string $onlineTimestamp
 * @property string $standingOwnerID
 * @property integer $state
 * @property string $stateTimestamp
 * @property string $typeID
 */
class YCorpStarbaseList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpStarbaseList the static model class
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
		return 'yapeal_corpStarbaseList';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, itemID, locationID, moonID, onlineTimestamp, standingOwnerID, state, stateTimestamp, typeID', 'required'),
			array('state', 'numerical', 'integerOnly'=>true),
			array('ownerID, itemID, locationID, moonID, standingOwnerID, typeID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, itemID, locationID, moonID, onlineTimestamp, standingOwnerID, state, stateTimestamp, typeID', 'safe', 'on'=>'search'),
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
			'itemID' => 'Item',
			'locationID' => 'Location',
			'moonID' => 'Moon',
			'onlineTimestamp' => 'Online Timestamp',
			'standingOwnerID' => 'Standing Owner',
			'state' => 'State',
			'stateTimestamp' => 'State Timestamp',
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

		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('itemID',$this->itemID,true);
		$criteria->compare('locationID',$this->locationID,true);
		$criteria->compare('moonID',$this->moonID,true);
		$criteria->compare('onlineTimestamp',$this->onlineTimestamp,true);
		$criteria->compare('standingOwnerID',$this->standingOwnerID,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('stateTimestamp',$this->stateTimestamp,true);
		$criteria->compare('typeID',$this->typeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}