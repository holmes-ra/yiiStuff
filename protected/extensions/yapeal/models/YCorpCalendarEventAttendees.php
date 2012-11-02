<?php

/**
 * This is the model class for table "yapeal_corpCalendarEventAttendees".
 *
 * The followings are the available columns in table 'yapeal_corpCalendarEventAttendees':
 * @property string $ownerID
 * @property string $characterID
 * @property string $characterName
 * @property string $response
 */
class YCorpCalendarEventAttendees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpCalendarEventAttendees the static model class
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
		return 'yapeal_corpCalendarEventAttendees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, characterID, characterName, response', 'required'),
			array('ownerID, characterID', 'length', 'max'=>20),
			array('characterName', 'length', 'max'=>255),
			array('response', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, characterID, characterName, response', 'safe', 'on'=>'search'),
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
			'characterID' => 'Character',
			'characterName' => 'Character Name',
			'response' => 'Response',
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
		$criteria->compare('characterID',$this->characterID,true);
		$criteria->compare('characterName',$this->characterName,true);
		$criteria->compare('response',$this->response,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}