<?php

/**
 * This is the model class for table "yapeal_corpWalletJournal".
 *
 * The followings are the available columns in table 'yapeal_corpWalletJournal':
 * @property string $ownerID
 * @property integer $accountKey
 * @property string $amount
 * @property string $argID1
 * @property string $argName1
 * @property string $balance
 * @property string $date
 * @property string $ownerID1
 * @property string $ownerID2
 * @property string $ownerName1
 * @property string $ownerName2
 * @property string $reason
 * @property string $refID
 * @property integer $refTypeID
 */
class YCorpWalletJournal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpWalletJournal the static model class
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
		return 'yapeal_corpWalletJournal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, accountKey, amount, balance, date, refID, refTypeID', 'required'),
			array('accountKey, refTypeID', 'numerical', 'integerOnly'=>true),
			array('ownerID, argID1, ownerID1, ownerID2, refID', 'length', 'max'=>20),
			array('amount, balance', 'length', 'max'=>17),
			array('argName1, ownerName1, ownerName2', 'length', 'max'=>255),
			array('reason', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, accountKey, amount, argID1, argName1, balance, date, ownerID1, ownerID2, ownerName1, ownerName2, reason, refID, refTypeID', 'safe', 'on'=>'search'),
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
			'accountKey' => 'Account Key',
			'amount' => 'Amount',
			'argID1' => 'Arg Id1',
			'argName1' => 'Arg Name1',
			'balance' => 'Balance',
			'date' => 'Date',
			'ownerID1' => 'Owner Id1',
			'ownerID2' => 'Owner Id2',
			'ownerName1' => 'Owner Name1',
			'ownerName2' => 'Owner Name2',
			'reason' => 'Reason',
			'refID' => 'Ref',
			'refTypeID' => 'Ref Type',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('argID1',$this->argID1,true);
		$criteria->compare('argName1',$this->argName1,true);
		$criteria->compare('balance',$this->balance,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('ownerID1',$this->ownerID1,true);
		$criteria->compare('ownerID2',$this->ownerID2,true);
		$criteria->compare('ownerName1',$this->ownerName1,true);
		$criteria->compare('ownerName2',$this->ownerName2,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('refID',$this->refID,true);
		$criteria->compare('refTypeID',$this->refTypeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}