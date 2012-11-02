<?php

/**
 * This is the model class for table "yapeal_charNotifications".
 *
 * The followings are the available columns in table 'yapeal_charNotifications':
 * @property string $ownerID
 * @property string $notificationID
 * @property integer $read
 * @property string $senderID
 * @property string $sentDate
 * @property integer $typeID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharNotifications extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharNotifications the static model class
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
		return 'yapeal_charNotifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, notificationID, read, senderID, sentDate, typeID', 'required'),
			array('read, typeID', 'numerical', 'integerOnly'=>true),
			array('ownerID, notificationID, senderID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, notificationID, read, senderID, sentDate, typeID', 'safe', 'on'=>'search'),
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
			'notificationID' => 'Notification',
			'read' => 'Read',
			'senderID' => 'Sender',
			'sentDate' => 'Sent Date',
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
		$criteria->compare('notificationID',$this->notificationID,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('senderID',$this->senderID,true);
		$criteria->compare('sentDate',$this->sentDate,true);
		$criteria->compare('typeID',$this->typeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}