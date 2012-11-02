<?php

/**
 * This is the model class for table "yapeal_accountAccountStatus".
 *
 * The followings are the available columns in table 'yapeal_accountAccountStatus':
 * @property string $keyID
 * @property string $createDate
 * @property string $logonCount
 * @property string $logonMinutes
 * @property string $paidUntil
 */
class YAccountAccountStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YAccountAccountStatus the static model class
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
		return 'yapeal_accountAccountStatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyID, createDate, logonCount, logonMinutes, paidUntil', 'required'),
			array('keyID, logonCount, logonMinutes', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('keyID, createDate, logonCount, logonMinutes, paidUntil', 'safe', 'on'=>'search'),
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
			'keyID' => 'Key',
			'createDate' => 'Create Date',
			'logonCount' => 'Logon Count',
			'logonMinutes' => 'Logon Minutes',
			'paidUntil' => 'Paid Until',
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

		$criteria->compare('keyID',$this->keyID,true);
		$criteria->compare('createDate',$this->createDate,true);
		$criteria->compare('logonCount',$this->logonCount,true);
		$criteria->compare('logonMinutes',$this->logonMinutes,true);
		$criteria->compare('paidUntil',$this->paidUntil,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}