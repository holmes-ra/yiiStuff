<?php

/**
 * This is the model class for table "yapeal_corpContainerLog".
 *
 * The followings are the available columns in table 'yapeal_corpContainerLog':
 * @property string $ownerID
 * @property string $action
 * @property string $actorID
 * @property string $actorName
 * @property integer $flag
 * @property string $itemID
 * @property string $itemTypeID
 * @property string $locationID
 * @property string $logTime
 * @property integer $newConfiguration
 * @property integer $oldConfiguration
 * @property string $passwordType
 * @property string $quantity
 * @property string $typeID
 */
class YCorpContainerLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpContainerLog the static model class
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
		return 'yapeal_corpContainerLog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, action, actorID, actorName, flag, itemID, itemTypeID, locationID, logTime, newConfiguration, oldConfiguration, passwordType, quantity, typeID', 'required'),
			array('flag, newConfiguration, oldConfiguration', 'numerical', 'integerOnly'=>true),
			array('ownerID, actorID, itemID, itemTypeID, locationID, quantity, typeID', 'length', 'max'=>20),
			array('action, actorName, passwordType', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, action, actorID, actorName, flag, itemID, itemTypeID, locationID, logTime, newConfiguration, oldConfiguration, passwordType, quantity, typeID', 'safe', 'on'=>'search'),
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
			'action' => 'Action',
			'actorID' => 'Actor',
			'actorName' => 'Actor Name',
			'flag' => 'Flag',
			'itemID' => 'Item',
			'itemTypeID' => 'Item Type',
			'locationID' => 'Location',
			'logTime' => 'Log Time',
			'newConfiguration' => 'New Configuration',
			'oldConfiguration' => 'Old Configuration',
			'passwordType' => 'Password Type',
			'quantity' => 'Quantity',
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
		$criteria->compare('action',$this->action,true);
		$criteria->compare('actorID',$this->actorID,true);
		$criteria->compare('actorName',$this->actorName,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('itemID',$this->itemID,true);
		$criteria->compare('itemTypeID',$this->itemTypeID,true);
		$criteria->compare('locationID',$this->locationID,true);
		$criteria->compare('logTime',$this->logTime,true);
		$criteria->compare('newConfiguration',$this->newConfiguration);
		$criteria->compare('oldConfiguration',$this->oldConfiguration);
		$criteria->compare('passwordType',$this->passwordType,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('typeID',$this->typeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}