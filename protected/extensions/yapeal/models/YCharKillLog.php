<?php

/**
 * This is the model class for table "yapeal_charKillLog".
 *
 * The followings are the available columns in table 'yapeal_charKillLog':
 * @property string $killID
 * @property string $killTime
 * @property string $moonID
 * @property string $solarSystemID
 *
 * The followings are the available model relations:
 * @property YCharAttackers[] $charAttackers
 * @property YCharItems[] $charItems
 * @property YCharVictim[] $charVictims
 */
class YCharKillLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharKillLog the static model class
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
		return 'yapeal_charKillLog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('killID, killTime, moonID, solarSystemID', 'required'),
			array('killID, moonID, solarSystemID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('killID, killTime, moonID, solarSystemID', 'safe', 'on'=>'search'),
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
			'charAttackers' => array(self::HAS_MANY, 'YCharAttackers', 'killID'),
			'charItems' => array(self::HAS_MANY, 'YCharItems', 'killID'),
			'charVictims' => array(self::HAS_MANY, 'YCharVictim', 'killID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'killID' => 'Kill',
			'killTime' => 'Kill Time',
			'moonID' => 'Moon',
			'solarSystemID' => 'Solar System',
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

		$criteria->compare('killID',$this->killID,true);
		$criteria->compare('killTime',$this->killTime,true);
		$criteria->compare('moonID',$this->moonID,true);
		$criteria->compare('solarSystemID',$this->solarSystemID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}