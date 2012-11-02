<?php

/**
 * This is the model class for table "yapeal_charContracts".
 *
 * The followings are the available columns in table 'yapeal_charContracts':
 * @property string $ownerID
 * @property string $contractID
 * @property string $issuerID
 * @property string $issuerCorpID
 * @property string $assigneeID
 * @property string $acceptorID
 * @property string $startStationID
 * @property string $endStationID
 * @property string $type
 * @property string $status
 * @property string $title
 * @property integer $forCorp
 * @property string $availability
 * @property string $dateIssued
 * @property string $dateExpired
 * @property string $dateAccepted
 * @property integer $numDays
 * @property string $dateCompleted
 * @property string $price
 * @property string $reward
 * @property string $collateral
 * @property string $buyout
 * @property string $volume
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharContracts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharContracts the static model class
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
		return 'yapeal_charContracts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, contractID, issuerID, issuerCorpID, assigneeID, acceptorID, startStationID, endStationID, type, status, forCorp, availability, dateIssued, dateExpired, numDays, price, reward, collateral, buyout, volume', 'required'),
			array('forCorp, numDays', 'numerical', 'integerOnly'=>true),
			array('ownerID, contractID, issuerID, issuerCorpID, assigneeID, acceptorID, startStationID, endStationID, volume', 'length', 'max'=>20),
			array('type, status, title, availability', 'length', 'max'=>255),
			array('price, reward, collateral, buyout', 'length', 'max'=>17),
			array('dateAccepted, dateCompleted', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, contractID, issuerID, issuerCorpID, assigneeID, acceptorID, startStationID, endStationID, type, status, title, forCorp, availability, dateIssued, dateExpired, dateAccepted, numDays, dateCompleted, price, reward, collateral, buyout, volume', 'safe', 'on'=>'search'),
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
			'contractID' => 'Contract',
			'issuerID' => 'Issuer',
			'issuerCorpID' => 'Issuer Corp',
			'assigneeID' => 'Assignee',
			'acceptorID' => 'Acceptor',
			'startStationID' => 'Start Station',
			'endStationID' => 'End Station',
			'type' => 'Type',
			'status' => 'Status',
			'title' => 'Title',
			'forCorp' => 'For Corp',
			'availability' => 'Availability',
			'dateIssued' => 'Date Issued',
			'dateExpired' => 'Date Expired',
			'dateAccepted' => 'Date Accepted',
			'numDays' => 'Num Days',
			'dateCompleted' => 'Date Completed',
			'price' => 'Price',
			'reward' => 'Reward',
			'collateral' => 'Collateral',
			'buyout' => 'Buyout',
			'volume' => 'Volume',
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
		$criteria->compare('contractID',$this->contractID,true);
		$criteria->compare('issuerID',$this->issuerID,true);
		$criteria->compare('issuerCorpID',$this->issuerCorpID,true);
		$criteria->compare('assigneeID',$this->assigneeID,true);
		$criteria->compare('acceptorID',$this->acceptorID,true);
		$criteria->compare('startStationID',$this->startStationID,true);
		$criteria->compare('endStationID',$this->endStationID,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('forCorp',$this->forCorp);
		$criteria->compare('availability',$this->availability,true);
		$criteria->compare('dateIssued',$this->dateIssued,true);
		$criteria->compare('dateExpired',$this->dateExpired,true);
		$criteria->compare('dateAccepted',$this->dateAccepted,true);
		$criteria->compare('numDays',$this->numDays);
		$criteria->compare('dateCompleted',$this->dateCompleted,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('reward',$this->reward,true);
		$criteria->compare('collateral',$this->collateral,true);
		$criteria->compare('buyout',$this->buyout,true);
		$criteria->compare('volume',$this->volume,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}