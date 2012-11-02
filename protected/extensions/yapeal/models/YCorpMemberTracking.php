<?php

/**
 * This is the model class for table "yapeal_corpMemberTracking".
 *
 * The followings are the available columns in table 'yapeal_corpMemberTracking':
 * @property string $base
 * @property string $baseID
 * @property string $characterID
 * @property string $grantableRoles
 * @property string $location
 * @property string $locationID
 * @property string $logoffDateTime
 * @property string $logonDateTime
 * @property string $name
 * @property string $ownerID
 * @property string $roles
 * @property string $shipType
 * @property string $shipTypeID
 * @property string $startDateTime
 * @property string $title
 */
class YCorpMemberTracking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpMemberTracking the static model class
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
		return 'yapeal_corpMemberTracking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('characterID, name, ownerID, startDateTime', 'required'),
			array('base, location, name, shipType', 'length', 'max'=>255),
			array('baseID, characterID, locationID, ownerID, shipTypeID', 'length', 'max'=>20),
			array('grantableRoles, roles', 'length', 'max'=>64),
			array('logoffDateTime, logonDateTime, title', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('base, baseID, characterID, grantableRoles, location, locationID, logoffDateTime, logonDateTime, name, ownerID, roles, shipType, shipTypeID, startDateTime, title', 'safe', 'on'=>'search'),
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
			'base' => 'Base',
			'baseID' => 'Base',
			'characterID' => 'Character',
			'grantableRoles' => 'Grantable Roles',
			'location' => 'Location',
			'locationID' => 'Location',
			'logoffDateTime' => 'Logoff Date Time',
			'logonDateTime' => 'Logon Date Time',
			'name' => 'Name',
			'ownerID' => 'Owner',
			'roles' => 'Roles',
			'shipType' => 'Ship Type',
			'shipTypeID' => 'Ship Type',
			'startDateTime' => 'Start Date Time',
			'title' => 'Title',
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

		$criteria->compare('base',$this->base,true);
		$criteria->compare('baseID',$this->baseID,true);
		$criteria->compare('characterID',$this->characterID,true);
		$criteria->compare('grantableRoles',$this->grantableRoles,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('locationID',$this->locationID,true);
		$criteria->compare('logoffDateTime',$this->logoffDateTime,true);
		$criteria->compare('logonDateTime',$this->logonDateTime,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('roles',$this->roles,true);
		$criteria->compare('shipType',$this->shipType,true);
		$criteria->compare('shipTypeID',$this->shipTypeID,true);
		$criteria->compare('startDateTime',$this->startDateTime,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}