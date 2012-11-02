<?php

/**
 * This is the model class for table "yapeal_corpAccountBalance".
 *
 * The followings are the available columns in table 'yapeal_corpAccountBalance':
 * @property string $ownerID
 * @property string $accountID
 * @property integer $accountKey
 * @property string $balance
 */
class YCorpAccountBalance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpAccountBalance the static model class
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
		return 'yapeal_corpAccountBalance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, accountID, accountKey, balance', 'required'),
			array('accountKey', 'numerical', 'integerOnly'=>true),
			array('ownerID, accountID', 'length', 'max'=>20),
			array('balance', 'length', 'max'=>17),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, accountID, accountKey, balance', 'safe', 'on'=>'search'),
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
			'accountID' => 'Account',
			'accountKey' => 'Account Key',
			'balance' => 'Balance',
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
		$criteria->compare('accountID',$this->accountID,true);
		$criteria->compare('accountKey',$this->accountKey);
		$criteria->compare('balance',$this->balance,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}