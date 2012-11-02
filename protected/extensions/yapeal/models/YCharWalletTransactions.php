<?php

/**
 * This is the model class for table "yapeal_charWalletTransactions".
 *
 * The followings are the available columns in table 'yapeal_charWalletTransactions':
 * @property string $ownerID
 * @property integer $accountKey
 * @property string $clientID
 * @property string $clientName
 * @property string $journalTransactionID
 * @property string $price
 * @property string $quantity
 * @property string $stationID
 * @property string $stationName
 * @property string $transactionDateTime
 * @property string $transactionFor
 * @property string $transactionID
 * @property string $transactionType
 * @property string $typeID
 * @property string $typeName
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharWalletTransactions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharWalletTransactions the static model class
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
		return 'yapeal_charWalletTransactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, accountKey, journalTransactionID, price, quantity, transactionDateTime, transactionID, typeID, typeName', 'required'),
			array('accountKey', 'numerical', 'integerOnly'=>true),
			array('ownerID, clientID, journalTransactionID, quantity, stationID, transactionID, typeID', 'length', 'max'=>20),
			array('clientName, stationName, transactionFor, transactionType, typeName', 'length', 'max'=>255),
			array('price', 'length', 'max'=>17),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, accountKey, clientID, clientName, journalTransactionID, price, quantity, stationID, stationName, transactionDateTime, transactionFor, transactionID, transactionType, typeID, typeName', 'safe', 'on'=>'search'),
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
			'clientID' => 'Client',
			'clientName' => 'Client Name',
			'journalTransactionID' => 'Journal Transaction',
			'price' => 'Price',
			'quantity' => 'Quantity',
			'stationID' => 'Station',
			'stationName' => 'Station Name',
			'transactionDateTime' => 'Transaction Date Time',
			'transactionFor' => 'Transaction For',
			'transactionID' => 'Transaction',
			'transactionType' => 'Transaction Type',
			'typeID' => 'Type',
			'typeName' => 'Type Name',
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
		$criteria->compare('clientID',$this->clientID,true);
		$criteria->compare('clientName',$this->clientName,true);
		$criteria->compare('journalTransactionID',$this->journalTransactionID,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('stationID',$this->stationID,true);
		$criteria->compare('stationName',$this->stationName,true);
		$criteria->compare('transactionDateTime',$this->transactionDateTime,true);
		$criteria->compare('transactionFor',$this->transactionFor,true);
		$criteria->compare('transactionID',$this->transactionID,true);
		$criteria->compare('transactionType',$this->transactionType,true);
		$criteria->compare('typeID',$this->typeID,true);
		$criteria->compare('typeName',$this->typeName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}