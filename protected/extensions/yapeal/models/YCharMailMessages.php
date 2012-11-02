<?php

/**
 * This is the model class for table "yapeal_charMailMessages".
 *
 * The followings are the available columns in table 'yapeal_charMailMessages':
 * @property string $ownerID
 * @property string $messageID
 * @property string $senderID
 * @property string $sentDate
 * @property string $title
 * @property string $toCharacterIDs
 * @property string $toCorpOrAllianceID
 * @property string $toListID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter[] $yapealUtilRegisteredCharacters
 */
class YCharMailMessages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharMailMessages the static model class
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
		return 'yapeal_charMailMessages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, messageID, senderID, sentDate', 'required'),
			array('ownerID, messageID, senderID, toCorpOrAllianceID', 'length', 'max'=>20),
			array('title', 'length', 'max'=>255),
			array('toCharacterIDs, toListID', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, messageID, senderID, sentDate, title, toCharacterIDs, toCorpOrAllianceID, toListID', 'safe', 'on'=>'search'),
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
			'yapealUtilRegisteredCharacters' => array(self::MANY_MANY, 'YUtilRegisteredCharacter', 'yapeal_charMailBodies(messageID, ownerID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ownerID' => 'Owner',
			'messageID' => 'Message',
			'senderID' => 'Sender',
			'sentDate' => 'Sent Date',
			'title' => 'Title',
			'toCharacterIDs' => 'To Character Ids',
			'toCorpOrAllianceID' => 'To Corp Or Alliance',
			'toListID' => 'To List',
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
		$criteria->compare('messageID',$this->messageID,true);
		$criteria->compare('senderID',$this->senderID,true);
		$criteria->compare('sentDate',$this->sentDate,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('toCharacterIDs',$this->toCharacterIDs,true);
		$criteria->compare('toCorpOrAllianceID',$this->toCorpOrAllianceID,true);
		$criteria->compare('toListID',$this->toListID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}