<?php

/**
 * This is the model class for table "yapeal_charStandingsFromFactions".
 *
 * The followings are the available columns in table 'yapeal_charStandingsFromFactions':
 * @property string $ownerID
 * @property string $fromID
 * @property string $fromName
 * @property string $standing
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharStandingsFromFactions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharStandingsFromFactions the static model class
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
		return 'yapeal_charStandingsFromFactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, fromID, fromName, standing', 'required'),
			array('ownerID, fromID', 'length', 'max'=>20),
			array('fromName', 'length', 'max'=>255),
			array('standing', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, fromID, fromName, standing', 'safe', 'on'=>'search'),
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
			'fromID' => 'From',
			'fromName' => 'From Name',
			'standing' => 'Standing',
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
		$criteria->compare('fromID',$this->fromID,true);
		$criteria->compare('fromName',$this->fromName,true);
		$criteria->compare('standing',$this->standing,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}