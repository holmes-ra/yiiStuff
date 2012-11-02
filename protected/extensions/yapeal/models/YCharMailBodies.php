<?php

/**
 * This is the model class for table "yapeal_charMailBodies".
 *
 * The followings are the available columns in table 'yapeal_charMailBodies':
 * @property string $ownerID
 * @property string $body
 * @property string $messageID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter[] $yapealUtilRegisteredCharacters
 */
class YCharMailBodies extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharMailBodies the static model class
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
		return 'yapeal_charMailBodies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, messageID', 'required'),
			array('ownerID, messageID', 'length', 'max'=>20),
			array('body', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, body, messageID', 'safe', 'on'=>'search'),
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
			'yapealUtilRegisteredCharacters' => array(self::MANY_MANY, 'YUtilRegisteredCharacter', 'yapeal_charMailMessages(messageID, ownerID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ownerID' => 'Owner',
			'body' => 'Body',
			'messageID' => 'Message',
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
		$criteria->compare('body',$this->body,true);
		$criteria->compare('messageID',$this->messageID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}