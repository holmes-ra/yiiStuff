<?php

/**
 * This is the model class for table "yapeal_charMarketOrders".
 *
 * The followings are the available columns in table 'yapeal_charMarketOrders':
 * @property string $ownerID
 * @property integer $accountKey
 * @property integer $bid
 * @property string $charID
 * @property integer $duration
 * @property string $escrow
 * @property string $issued
 * @property string $minVolume
 * @property string $orderID
 * @property integer $orderState
 * @property string $price
 * @property integer $range
 * @property string $stationID
 * @property string $typeID
 * @property string $volEntered
 * @property string $volRemaining
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharMarketOrders extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharMarketOrders the static model class
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
		return 'yapeal_charMarketOrders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, accountKey, bid, charID, duration, escrow, issued, minVolume, orderID, orderState, price, range, volEntered, volRemaining', 'required'),
			array('accountKey, bid, duration, orderState, range', 'numerical', 'integerOnly'=>true),
			array('ownerID, charID, minVolume, orderID, stationID, typeID, volEntered, volRemaining', 'length', 'max'=>20),
			array('escrow, price', 'length', 'max'=>17),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, accountKey, bid, charID, duration, escrow, issued, minVolume, orderID, orderState, price, range, stationID, typeID, volEntered, volRemaining', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'YUtilRegisteredCharacter', 'ownerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ownerID' => 'Owner',
			'accountKey' => 'Account Key',
			'bid' => 'Bid',
			'charID' => 'Char',
			'duration' => 'Duration',
			'escrow' => 'Escrow',
			'issued' => 'Issued',
			'minVolume' => 'Min Volume',
			'orderID' => 'Order',
			'orderState' => 'Order State',
			'price' => 'Price',
			'range' => 'Range',
			'stationID' => 'Station',
			'typeID' => 'Type',
			'volEntered' => 'Vol Entered',
			'volRemaining' => 'Vol Remaining',
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
		$criteria->compare('accountKey',$this->accountKey);
		$criteria->compare('bid',$this->bid);
		$criteria->compare('charID',$this->charID,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('escrow',$this->escrow,true);
		$criteria->compare('issued',$this->issued,true);
		$criteria->compare('minVolume',$this->minVolume,true);
		$criteria->compare('orderID',$this->orderID,true);
		$criteria->compare('orderState',$this->orderState);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('range',$this->range);
		$criteria->compare('stationID',$this->stationID,true);
		$criteria->compare('typeID',$this->typeID,true);
		$criteria->compare('volEntered',$this->volEntered,true);
		$criteria->compare('volRemaining',$this->volRemaining,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}